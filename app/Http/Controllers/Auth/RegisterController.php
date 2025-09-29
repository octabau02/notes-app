<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $user = Auth::user();
        if(!empty($user)){
            return redirect('dashboard');
        }
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:255',
            'email' => 'string|email|required',
            'password' => 'string|required|min:8',
        ]);

        $emailRegistered = DB::table('users')
            ->where('email', '=', $request->email)
            ->exists();

        if($emailRegistered){
            return redirect('register')->withErrors(['El correo ingresado ya esta registrado'])->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ];

        DB::beginTransaction();
        try{
            DB::table('users')->insert($userData);
            DB::commit();
            return redirect('login')->with('success', 'Usuario Registrado correctamente');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect('register')->withErrors(['Ocurrio un error al registrar el usuario' . $e->getMessage()])->withInput();
        }
        return redirect('register')->withErrors(['No se pudo registrar al usuario'])->withInput();
    }
}
