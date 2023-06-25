<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Http\Resources\User as ResourcesUsers;
use App\Models\User;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'password' => Hash::make($request->password)
        ]);
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API key token pour '.$user->name)->plainTextToken
        ]);
        
    }

    function update(UpdateUsersRequest $request,$id){
        $request->validated($request->all());
        $user= User::find($id);
        $user->update([
            "name"=>$request->name,
            "email"=>$request->email
        ]);

        return $this->success([
            'user'=>$user
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

    function login(Request $request)
    {
        $credentials=["email"=>$request->email, "password"=>$request->password];
        if (!Auth::attempt($credentials)) {
            return $this->erreur($credentials,'Email ou mot de passe incorect',201);
        }

        $user = User::where("email",$request->email)->first();

        return $this->loginUser([
            'user'=>$user,
            'token'=>$user->createToken('API key token pour '.$user->name)->plainTextToken
        ]);

        
    }

    function logout()
    {
        
        return $this->logoutUser('','Vous etes déconnecté',205);
    }

}
