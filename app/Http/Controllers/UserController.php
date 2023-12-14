<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{



    public function index()
    {
        $users = User::all();
        $username = Auth::user()->name; // Obtén al usuario autenticado
    
        return view('users.index', compact('users', 'username'))->with('isAdmin', $this->getIsAdmin());
    }

    private function getIsAdmin()
    {
        $user = Auth::user();
        return $user ? $user->admin : false;
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'codigopostal' => 'nullable|digits:5|numeric',
            'direccion' => 'nullable|string|max:50',
            'telefono' => 'nullable|digits_between:7,20|numeric',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de caracteres.',
            'name.max' => 'El nombre no puede exceder los 50 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'codigopostal.digits' => 'El código postal debe contener exactamente :digits dígitos.',
            'codigopostal.numeric' => 'El código postal debe contener solo números.',
            'direccion.string' => 'La dirección debe ser una cadena de caracteres.',
            'direccion.max' => 'La dirección no puede exceder los 50 caracteres.',
            'telefono.digits_between' => 'El teléfono debe tener :min digitos.',
            'telefono.numeric' => 'El teléfono debe contener solo números.',
        ]);

        // Creación de un nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->admin = $request->has('admin') ? true : false;
        $user->codigopostal = $request->input('codigopostal');
        $user->direccion = $request->input('direccion');
        $user->telefono = $request->input('telefono');
        $user->save();

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    // Validación de los datos del formulario
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
        'telefono.digits_between' => 'El teléfono debe tener :min digitos.',
        'telefono.numeric' => 'El teléfono debe contener solo números.',
    ]);

    // Actualización del usuario
    $user = User::find($id);
    $user->name = $request->input('name');
    $user->admin = $request->has('admin') ? true : false;
    $user->codigopostal = $request->input('codigopostal');
    $user->direccion = $request->input('direccion');
    $user->telefono = $request->input('telefono');

    $user->save();

    return redirect()->route('users.index');
}

    public function confirmDelete($id)
    {
        $user = User::find($id);
        return view('users.confirmDelete', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        // Verificar si el usuario autenticado intenta eliminarse a sí mismo
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();

        return redirect()->route('users.index');
    }
}