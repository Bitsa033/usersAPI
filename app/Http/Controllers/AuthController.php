<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Resources\Users as ResourcesUsers;
use App\Models\User;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponse;

    function register(StoreUsersRequest $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password')
        ]);
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API key token pour '.$user->name)->plainTextToken
        ]);
    }

    function login()
    {
        return 'Cette méthode permet de se connecter';
    }

    function logout()
    {
        return 'Cette méthode permet de se déconnecter';
    }

    function getAll()
    {
        $user = User::all();
        return new ResourcesUsers($user);
    }
}
