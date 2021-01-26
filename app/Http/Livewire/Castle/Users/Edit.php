<?php

namespace App\Http\Livewire\Castle\Users;

use App\Models\Rates;
use App\Models\Region;
use App\Models\User;
use App\Repositories\OfficeRepository;
use App\Repositories\RateRepository;
use App\Repositories\UserRepository;
use App\Services\UserCanChangeRole;
use App\Traits\Livewire\Actions;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use Actions;

    public User $user;

    public User $originalUser;

    public $canChange;

    public $selectedDepartment;

    public $roles;

    public $offices;

    public $departments;

    protected $rules = [
        'user.first_name'    => ['required', 'string', 'max:255'],
        'user.last_name'     => ['required', 'string', 'max:255'],
        'user.role'          => ['nullable', 'string', 'max:255'],
        'user.office_id'     => 'nullable',
        'user.pay'           => 'nullable',
        'user.department_id' => 'nullable',
        'user.email'         => 'required',
    ];

    private OfficeRepository $officeRepository;

    private UserRepository $userRepository;

    private RateRepository $rateRepository;

    private UserCanChangeRole $userCanChangeRole;

    public function __construct()
    {
        $this->officeRepository  = resolve(OfficeRepository::class);
        $this->userRepository    = resolve(UserRepository::class);
        $this->rateRepository    = resolve(RateRepository::class);
        $this->userCanChangeRole = resolve(UserCanChangeRole::class);
    }

    public function mount(User $user)
    {
        $this->originalUser = $user;
        $this->selectedDepartment = $user->department_id;
    }

    public function render()
    {
        $this->roles   = $this->userRepository->getRolesPerUrserRole(user());
        $this->offices = $this->officeRepository->getOffices($this->selectedDepartment);

        if(!$this->canChange) {
            $this->user->role = $this->originalUser->role;
        }

        return view('livewire.castle.users.edit');
    }



    public function resetPassword($id)
    {
        $user = User::find($id);

        $data = Validator::make(request()->all(), [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $user
            ->changePassword($data['new_password'])
            ->save();

        alert()->withTitle(__('Password reset successfully!'))->send();

        return redirect(route('castle.users.edit', compact('user')));
    }

    public function getOffices(int $departmentId){
        $this->offices = $this->officeRepository->getOffices($departmentId);
    }

    public function getRegionsManager($departmentId)
    {
        return User::whereDepartmentId($departmentId)
            ->whereRole("Region Manager")
            ->get();
    }

    public function getOfficesManager($regionId)
    {
        $region = Region::whereId($regionId)->first();

        $usersQuery = User::query()->select("users.*");

        return $usersQuery->whereRole("Office Manager")
            ->whereDepartmentId($region->department_id)
            ->get();
    }

    public function getRoles()
    {
        return User::ROLES;
    }

    public function getUsers()
    {
        $usersQuery = User::when(user()->department_id, function ($query) {
            $query->whereDepartmentId(user()->department_id);
        });

        return $usersQuery->get();
    }

    public function changeRole(string $role): void
    {
        $canChange = $this->userCanChangeRole->handler($this->originalUser);
        $this->canChange = $canChange['status'];
        if ($canChange['status']) {
            $this->user->pay = $this->rateRepository->getRatesPerRole($role)->rate ?? $this->user->pay;
        } else {
            $this->showModal([
                'icon'  => 'warning',
                'title' => 'Warning!!',
                'text'  => $canChange['message'],
            ]);
        }
    }

    public function changeDepartment(int $departmentId): void
    {
        $this->selectedDepartment = $departmentId;
    }

    public function getUserRate($userId)
    {
        $user  = User::whereId($userId)->first();

        $rate = Rates::whereRole($user->role);
        $rate->when($user->role == 'Sales Rep', function($query) use ($user) {
            $query->where('time', "<=", $user->installs)->orderBy('time', 'desc');
        });

        if($rate) {
            return $user->pay;
        }else{
            return $rate->first()->rate;
        };
    }
}
