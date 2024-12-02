<?php
// app/Http/Controllers/ArchivoController.php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archivos = Archivo::all();
        if ($archivos->isEmpty()) {
            return redirect()->route('archivos.create');
        }
        return view('archivos.index', compact('archivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('archivos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  
     public function store(Request $request)
        {
            $request->validate([
                'archivos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación: solo imágenes
            ]);

            foreach ($request->file('archivos') as $archivo) {
                $archivoOriginal = $archivo->getClientOriginalName();
                $archivoNombre = date('H_i') . '_' . date('d_m_Y') . '_' . $archivoOriginal;
                $ruta = $archivo->storeAs('archivos', $archivoNombre, 'private');

                Archivo::create([
                    'nombre_original' => $archivoOriginal,
                    'nombre' => $archivoNombre,
                    'ruta' => $ruta,
                ]);
            }

            return back()->with('success', 'Archivos subidos exitosamente.');
        }

    /**
     * Display the table of the resource.
     */
    public function table()
    {
        $archivos = Archivo::all();
        return view('archivos.table', compact('archivos'));
    }

    /**
     * Serve the image file.
     */
    
     public function show($id)
     {
         $archivo = Archivo::findOrFail($id);
         $ruta = storage_path('app/private/' . $archivo->ruta);
     
         if (!Storage::disk('private')->exists($archivo->ruta)) {
             abort(404);
         }
     
         return response()->file($ruta);
     }


    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);
        $ruta = storage_path('app/private/' . $archivo->ruta);

        if (Storage::disk('private')->exists($archivo->ruta)) {
            Storage::disk('private')->delete($archivo->ruta);
        }

        $archivo->delete();

        return redirect()->route('archivos.table')->with('success', 'Archivo borrado exitosamente.');
    }
}