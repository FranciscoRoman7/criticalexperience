<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function show()
    {
        $users = Auth::user();
        $username = Auth::user()->name;
    
        return view('perfil', compact('users', 'username'))->with('isAdmin', $this->getIsAdmin());
    }

    private function getIsAdmin()
    {
        $user = Auth::user();
        return $user ? $user->admin : false;
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:50',
            'codigopostal' => 'nullable|digits:5|numeric',
            'direccion' => 'nullable|string|max:50',
            'telefono' => 'nullable|digits_between:9,9|numeric',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de caracteres.',
            'name.max' => 'El nombre no puede exceder los 50 caracteres.',
            'codigopostal.digits' => 'El código postal debe contener exactamente :digits dígitos.',
            'codigopostal.numeric' => 'El código postal debe contener solo números.',
            'direccion.string' => 'La dirección debe ser una cadena de caracteres.',
            'direccion.max' => 'La dirección no puede exceder los 50 caracteres.',
            'telefono.digits_between' => 'El teléfono debe tener :min dígitos.',
            'telefono.numeric' => 'El teléfono debe contener solo números.',
        ]);

        if ($request->filled('codigopostal')) {
            $request->validate([
                'codigopostal' => 'regex:/^\d{5}$/',
            ], [
                'codigopostal.regex' => 'El código postal debe tener 5 dígitos.',
            ]);
        }

        if ($request->filled('telefono')) {
            $request->validate([
                'telefono' => 'regex:/^\d{7,20}$/',
            ], [
                'telefono.regex' => 'El teléfono debe contener entre 7 y 20 dígitos.',
            ]);
        }

        $user->name = $request->input('name');
        $user->codigopostal = $request->input('codigopostal');
        $user->direccion = $request->input('direccion');
        $user->telefono = $request->input('telefono');

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'El campo de contraseña actual es obligatorio.',
            'new_password.required' => 'El campo de nueva contraseña es obligatorio.',
            'new_password.string' => 'La nueva contraseña debe ser una cadena de caracteres.',
            'new_password.min' => 'La nueva contraseña debe tener al menos :min caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual que has introducido es incorrecta.');
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Contraseña cambiada exitosamente.');
    }

}