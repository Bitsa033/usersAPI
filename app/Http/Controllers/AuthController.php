<?php

namespace App\Http\Controllers;

use App\Trait\HttpResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponse;

    function login()
    {
        return 'Cette méthode permet de se connecter';
    }

    function logout()
    {
        return 'Cette méthode permet de se déconnecter';
    }
}
