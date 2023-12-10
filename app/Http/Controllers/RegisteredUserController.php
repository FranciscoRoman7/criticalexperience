<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);
    
        // Verificar si el correo electrónico ya existe en la base de datos
        $existingUser = User::where('email', $request->email)->exists();
    
        if ($existingUser) {
            return redirect()->back()->with('registration_error', 'Este correo electrónico ya está registrado.');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    
        return redirect('/')->with('success', '¡Usuario registrado exitosamente!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio para iniciar sesión.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'password.required' => 'El campo contraseña es obligatorio para iniciar sesión.',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/home');
        } else {
            return redirect('/')
                ->with('login_error', 'Credenciales inválidas. Verifica tu correo electrónico y contraseña.')
                ->withInput();
        }
    }

}
