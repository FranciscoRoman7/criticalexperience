<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiradaDado;
use Illuminate\Support\Facades\Auth;


class TiradaDadoController extends Controller
{


    public function guardar(Request $request)
    {
        // Obtener los datos de la tirada de dados del formulario
        $emailUsuario = auth()->user()->email;
        $tipoDado = $request->tipo_dado;
        $bonificador = $request->bonificador;
        $resultado = mt_rand(1, $tipoDado); // Simulación del resultado del dado
    
        // Calcular el total (resultado + bonificador)
        $total = $resultado + $bonificador;
    
        // Guardar la tirada de dado en la base de datos
        TiradaDado::create([
            'email_usuario' => $emailUsuario,
            'tipo_dado' => $tipoDado,
            'bonificador' => $bonificador,
            'resultado' => $resultado,
            'total' => $total, // Agregar el campo 'total' en la tabla y guardar el resultado + bonificador
        ]);
    
        return response()->json(['message' => 'Datos guardados correctamente']);    
    }

        public function mostrar()
    {
        $tiradas = TiradaDado::where('email_usuario', auth()->user()->email)->get();

        if (request()->expectsJson()) {
            return response()->json(['tiradas' => $tiradas]);
        }

        $user = auth()->user();
        $isAdmin = $user ? $user->admin : false;

        $data = [
            'username' => $user ? $user->name : null,
            'isAdmin' => $isAdmin,
            'tiradas' => $tiradas,
        ];

        return view('dados', $data);
    }

    public function borrarTiradas()
    {
        $userEmail = auth()->user()->email;

        TiradaDado::where('email_usuario', $userEmail)->delete();


        return response()->json(['message' => 'Datos guardados correctamente']);    

    }
}
