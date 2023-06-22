<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as ResourcesUsers;
use App\Models\User;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $user= DB::table('users')->where('id', '=', $id)->get();
            return new ResourcesUsers($user);
        }
        
    }

    function store(Request $request)
    {
        if (!empty($request->get('name')) && !empty($request->get('email')) && !empty($request->get('password'))) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password')
            ]);
            return $this->success([
                'user'=>$user,
                'token'=>$user->createToken('API key token pour '.$user->name)->plainTextToken
            ]);
            # code...
        } else {
            return "Verifiez vos champs: le nom, l'email et le password 
            ne doivent pas etre vide ";
        }
        
    }

    function update(Request $request,$id){
        $user= User::find($id);
        $user->update(["name"=>$request->name]);

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

}
