<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'region'         => ['required', 'string', 'min:3', 'max:255'],
            'first_name'     => ['required', 'string', 'min:3', 'max:255'],
            'last_name'      => ['required', 'string', 'min:3', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:128', 'unique:users', 'confirmed'],
            'password'       => ['required', 'string', 'min:8', 'max:128'],
        ]);
    }

    protected function create(array $data)
    {
        $user                 = new User();
        $user->first_name     = $data['first_name'];
        $user->last_name      = $data['last_name'];
        $user->email          = $data['email'];
        $user->password       = bcrypt($data['password']);
        $user->save();

        $team           = new Region();
        $team->name     = $data['region'];
        $team->owner_id = $user->id;
        $team->save();

        $team->users()->attach($user, ['role' => 'owner']);


        return $user;
    }
}
