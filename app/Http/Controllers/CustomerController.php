<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Rates;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $this->authorize('viewList', Customer::class);

        return redirect()->route('home');
    }

    public function create()
    {
        $this->authorize('create', Customer::class);

        $bills       = Customer::BILLS;
        $financings  = Customer::FINANCINGS;
        $openedById  = Auth::user()->id;
        $users       = User::get();
        $setterFee   = $this->getSetterFee();
        $salesRepFee = $this->getSalesRepFee();

        return view('customer.create',
            [
                'bills'       => $bills,
                'financings'  => $financings,
                'openedById'  => $openedById,
                'users'       => $users,
                'setterFee'   => $setterFee->rate ?? 0,
                'salesRepFee' => $salesRepFee->rate ?? 0,
            ]
        );
    }

    public function delete(Customer $customer)
    {
        $customer->delete();

        alert()
            ->withTitle(__('Home Owner deleted!'))
            ->send();

        return redirect()->route('home');
    }

    public function calculateCommission($customer)
    {
        return (($customer->epc - ( $customer->pay + $customer->setter_fee )) * ($customer->system_size * 1000)) - $customer->adders;
    }

    public function show(Customer $customer)
    {
        $this->authorize('view', Customer::class);

        $users = User::get();

        return view('customer.show',
        [
            'customer'   => $customer,
            'users'      => $users,
        ]);
    }

    public function update(Customer $customer)
    {
        $this->authorize('update', Customer::class);

        $validated = request()->validate(
            [
                'first_name'    => 'required|string|min:3|max:255',
                'last_name'     => 'required|string|min:3|max:255',
                'system_size'   => 'required',
                'bill'          => 'required',
                'adders'        => 'required',
                'epc'           => 'required',
                'financing_id'  => 'required',
                'financer_id'   => 'integer|nullable',
                'term_id'       => 'integer|nullable',
                'setter_id'     => 'required',
                'setter_fee'    => 'required',
                'sales_rep_fee' => 'required',
                'sales_rep_id'  => 'required',
                'panel_sold'    => 'nullable',
            ]
        );

        if ($customer->panel_sold != $validated['panel_sold']) {
            $user = User::whereId($validated['sales_rep_id'])->first();

            if ($validated['panel_sold'] == 1) {
                $user->installs++;
            }

            if ($validated['panel_sold'] == 0) {
                $user->installs--;
            }

            $user->save();
        }

        $customer->first_name    = $validated['first_name'];
        $customer->last_name     = $validated['last_name'];
        $customer->bill          = $validated['bill'];
        $customer->financing_id  = $validated['financing_id'];
        $customer->financer_id   = $validated['financer_id'] ?? null;
        $customer->term_id       = $validated['term_id'] ?? null;
        $customer->system_size   = $validated['system_size'];
        $customer->adders        = $validated['adders'];
        $customer->epc           = $validated['epc'];
        $customer->setter_id     = $validated['setter_id'];
        $customer->setter_fee    = $validated['setter_fee'];
        $customer->sales_rep_fee = $validated['sales_rep_fee'];
        $customer->sales_rep_id  = $validated['sales_rep_id'];

        $commission = $this->calculateCommission($customer);

        $customer->commission = $commission;

        $customer->save();

        alert()
            ->withTitle(__('Home Owner updated!'))
            ->send();

        return redirect(route('customers.show', $customer->id));
    }

    public function active(Customer $customer)
    {
        $this->authorize('update', Customer::class);

        $customer->is_active = !$customer->is_active;
        $customer->save();

        if ($customer->is_active == true) {
            alert()
            ->withTitle(__('Home Owner set as active!'))
            ->send();
        } else {
            alert()
            ->withTitle(__('Home Owner set as canceled!'))
            ->send();
        }

        return redirect(route('customers.show', $customer));
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', Customer::class);

        return redirect(route('customers.index'))->with('message', 'Home Owner deleted!');
    }

    public function getSetterFee()
    {
        return Rates::whereRole('Setter')->first();
    }

    public function getSalesRepFee()
    {
        return Rates::whereRole('Sales Rep')->orderBy('rate', 'desc')->first();
    }
}
