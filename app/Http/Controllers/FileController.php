<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\StreamedResponse;


class FileController extends Controller
{


    
    public function index(Request $request)
    {
        $username = Auth::user()->name;
        $campaigns = Campaign::where('email_usuario', auth()->user()->email)->get();
        $selectedCampaign = $request->input('campaign_id', '');

        // Obtenemos los archivos correspondientes a la campaña seleccionada
        $files = $selectedCampaign ? Campaign::findOrFail($selectedCampaign)->files : collect();

        $user = Auth::user();
        $isAdmin = $user ? $user->admin : false;

        return view('files', compact('campaigns', 'files', 'username', 'selectedCampaign', 'isAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'file' => 'required|mimes:pdf,doc,ods,docx,odt,txt,xls,xlsx,csv,jpg,jpeg,png,gif' // Documentos permitidos

        ]);

        // Procesar el archivo
        $file = $request->file('file');
        $campaignId = $request->input('campaign_id');
        // Guardar el archivo en storage
        $filePath = $file->store('files', 'public');

        // Crear el registro en la base de datos
        $newFile = File::create([
            'campaign_id' => $campaignId,
            'name' => $file->getClientOriginalName(),
            'file_data' => $filePath,
        ]);

        $selectedCampaign = $request->input('campaign_id');

        return redirect()->route('files.index', ['campaign_id' => $selectedCampaign]);
    }

    public function show(File $file)
    {
        $filePath = storage_path('app/public/' . $file->file_data);

        if (Storage::exists('public/' . $file->file_data)) {
            $fileContent = Storage::get('public/' . $file->file_data);

            $mimeType = Storage::mimeType('public/' . $file->file_data);

            return response($fileContent)
                ->header('Content-Type', $mimeType);
        }

        return redirect()->route('files.index')->with('error', 'File not found.');
    }


    public function download(File $file)
    {
        try {
            $filePath = storage_path('app/public/' . $file->file_data);

            if (Storage::exists('public/' . $file->file_data)) {
                return response()->download($filePath, $file->name);
            }

            return redirect()->route('files.index')->with('error', 'File not found.');
        } catch (\Exception $e) {
            return redirect()->route('files.index')->with('error', 'Error downloading file: ' . $e->getMessage());
        }
    }


    public function destroy(File $file)
    {
        try {
            $selectedCampaign = $file->campaign_id;
            $filePath = 'public/' . $file->file_data;

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            $file->delete();

            return redirect()->route('files.index', ['campaign_id' => $selectedCampaign]);
        } catch (\Exception $e) {
            return redirect()->route('files.index')->with('error', 'Error deleting file: ' . $e->getMessage());
        }
    }
}