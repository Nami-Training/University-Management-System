<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Trait\AuthTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    use AuthTrait;

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    public function loginForm($type)
    {
        return view('auth.login', compact('type'));
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
         }
    }

    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
