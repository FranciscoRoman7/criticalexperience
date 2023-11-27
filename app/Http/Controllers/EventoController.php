<?php

namespace App\Http\Controllers;

use App\Models\evento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{

    public function __construct()
    {
        $user = Auth::user();
        $isAdmin = $user ? $user->admin : false;
        view()->share('isAdmin', $isAdmin);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('calendario', ['username' => Auth::user()->name])->with('isAdmin', $this->getIsAdmin());
    }

    private function getIsAdmin()
    {
        $user = Auth::user();
        return $user ? $user->admin : false;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(evento::$rules);
        $evento=evento::create($request->all());
        
        if ($evento) {
            return response()->json($evento);
        } else {
            return redirect()->back()->with('error', 'Error al crear el evento');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(evento $evento)
    {
        // Obtén el usuario autenticado
    $user = auth()->user();
    $userEmail = $user->email;

    // Filtra los eventos por el email del usuario logueado
    $eventos = evento::where('email', $userEmail)->get();

    return response()->json($eventos);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $evento = evento::find($id);
        $evento->start=Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d');
        $evento->end=Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d');
        
        
        
        
        return response()->json($evento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, evento $evento)
    {
        
        request()->validate(evento::$rules);
        $evento->update($request->all());



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evento=evento::find($id)->delete();
        return response()->json($evento);
    }
}
