<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthValidate;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth');
    }

    public function auth(AuthValidate $authValidate)
    {
        $credentials = $authValidate->safe()->only(['email','password']);

        if(Auth::attempt($credentials))
        {
            $authValidate->session()->regenerate();

            if(Auth::user()->is_admin)
            {
                return redirect(route('admin'));
            }

            return redirect(route('order'));
        }

        return back();

    }
}
