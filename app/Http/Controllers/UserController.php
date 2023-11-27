<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Creación de un nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->admin = $request->has('admin') ? true : false;
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
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:8', // Puedes ajustar las reglas de validación según tus necesidades
    ]);

    // Actualización del usuario
    $user = User::find($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Actualizar la contraseña solo si se proporciona una nueva
    if ($request->has('password') && !empty($request->input('password'))) {
        $user->password = bcrypt($request->input('password'));
    }
    $user->admin = $request->has('admin') ? true : false;

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