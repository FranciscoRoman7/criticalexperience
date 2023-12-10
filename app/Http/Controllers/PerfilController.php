<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de caracteres.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $user->name = $request->input('name');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
    }
}