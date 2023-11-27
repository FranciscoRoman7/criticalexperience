<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;

class CampaignController extends Controller
{

    public function index()
    {
        $username = Auth::user()->name; // Obtén el nombre del usuario actual
        $campaigns = Campaign::where('email_usuario', Auth::user()->email)->get();
        return view('campaigns.index', compact('campaigns', 'username'))->with('isAdmin', $this->getIsAdmin());
    }

    private function getIsAdmin()
    {
        $user = Auth::user();
        return $user ? $user->admin : false;
    }


    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ambientacion' => 'required',
            'descripcion' => 'required',
        ]);

        $campaign = new Campaign($request->all());
        $campaign->email_usuario = Auth::user()->email;
        $campaign->save();

        return redirect()->route('campaigns.index')->with('success', 'Campaña creada correctamente.');
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'ambientacion' => 'required',
            'descripcion' => 'required',
        ]);

        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());

        return redirect()->route('campaigns.index')->with('success', 'Campaña actualizada correctamente.');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect()->route('campaigns.index')->with('success', 'Campaña eliminada correctamente.');
    }
}