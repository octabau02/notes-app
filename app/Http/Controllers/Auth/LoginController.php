<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $user = Auth::user();
        if(!empty($user)){
            return redirect('dashboard');
        }
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();
        //dd($user,Hash::check($request->password, $user->password));
        if ($user && Hash::check($request->password, $user->password)){
            Auth::loginUsingId($user->id);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['Las credenciales ingresadas no coinciden. Asegurate de que estan escritas correctamente.'])->onlyInput('email');
    }
}
