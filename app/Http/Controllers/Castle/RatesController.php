<?php

namespace App\Http\Controllers\Castle;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Rates;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('castle.rate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::query()->get();

        return view('castle.rate.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate(
            request(),
            [
                'name'              => 'required|string|min:3|max:255',
                'time'              => 'required',
                'rate'              => 'required',
                'department_id'     => 'required',
            ]
        );

        $rate                = new Rates();
        $rate->name          = $validated['name'];
        $rate->time          = $validated['time'];
        $rate->rate          = $validated['rate'];
        $rate->department_id = $validated['department_id'];
    
        $rate->save();

        alert()
            ->withTitle(__('Rate created!'))
            ->send();

        return redirect(route('castle.rates.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rates $rate)
    {
       $departments = Department::get();

       return view('castle.rate.edit', compact('rate', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validated = $this->validate(
            request(),
            [
                'name'              => 'required|string|min:3|max:255',
                'time'              => 'required',
                'rate'              => 'required',
                'department_id'     => 'required',
            ]
        );
        $rate                = Rates::whereId($id)->first();
        $rate->name          = $validated['name'];
        $rate->time          = $validated['time'];
        $rate->rate          = $validated['rate'];
        $rate->department_id = $validated['department_id'];
        
        $rate->save();

        alert()
            ->withTitle(__('Rate updated!'))
            ->send();

        return redirect(route('castle.rates.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rates $rate)
    {
        $rate->delete();

        alert()
            ->withTitle(__('Rate deleted!'))
            ->send();

        return redirect(route('castle.rates.index'));
    }
}