<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Resources\User as ResourcesUsers;
use App\Models\User;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponse;

    function getAll()
    {
        $user = User::all();
        return new ResourcesUsers($user);
    }

    /**
     * Display the specified animal resource.
     */
    public function getOne($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $user= User::find($id);
            return new ResourcesUsers($user);
        }
        
    }

    function store(StoreUsersRequest $request)
    {
        $request->validated($request->all());
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

    function update(StoreUsersRequest $request,$id){
        $request->validated($request->all());
        $user= User::find($id);
        $user->update([
            "name"=>$request->name,
            "email"=>$request->email
        ]);

        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API key token pour '.$user->name)->plainTextToken
        ]);
        
    }

    public function delete($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $user=User::destroy($id);
            return $this->success([
                'user'=>$user
                // 'token'=>$user->remo('API key token pour '.$user->name)->plainTextToken
            ]);
        }
        
    }

    function login()
    {
        
        return 'Cette méthode permet de se connecter';
        
    }

    function logout()
    {
        return 'Cette méthode permet de se déconnecter';
    }

}
