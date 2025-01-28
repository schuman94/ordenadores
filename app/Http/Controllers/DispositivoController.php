<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDispositivoRequest;
use App\Http\Requests\UpdateDispositivoRequest;
use App\Models\Dispositivo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dispositivos.index', [
            'dispositivos' => Dispositivo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dispositivos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|unique:dispositivos,codigo',
            'nombre' => 'required|string',
            'colocable_type' => 'required|string|in:App\Models\Ordenador,App\Models\Aula',
            'colocable_codigo' => 'required|string',
        ]);

        // Buscar el modelo colocable usando el tipo y el código
        $colocable = $validated['colocable_type']::where('codigo', $validated['colocable_codigo'])->first();

        // Si no se encuentra el modelo, lanzar error
        if (!$colocable) {
            return back()->withErrors(['colocable_codigo' => 'No se encontró el colocable con el código especificado.'])->withInput();
        }

        $dispositivo = Dispositivo::create([
            'codigo' => $validated['codigo'],
            'nombre' => $validated['nombre'],
            'colocable_type' => $validated['colocable_type'],
            'colocable_id' => $colocable->id
        ]);

        session()->flash('exito', 'Dispositivo creado correctamente.');
        return redirect()->route('dispositivos.show', $dispositivo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dispositivo $dispositivo)
    {
        return view('dispositivos.show', [
            'dispositivo' => $dispositivo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dispositivo $dispositivo)
    {
        return view('dispositivos.edit',[
            'dispositivo' => $dispositivo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dispositivo $dispositivo)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                Rule::unique('dispositivos')->ignore($dispositivo),
            ],
            'nombre' => 'required|string',
            'colocable_type' => 'required|string|in:App\Models\Ordenador,App\Models\Aula',
            'colocable_codigo' => 'required|string',
        ]);

        // Buscar el modelo colocable usando el tipo y el código
        $colocable = $validated['colocable_type']::where('codigo', $validated['colocable_codigo'])->first();

        // Si no se encuentra el modelo, lanzar error
        if (!$colocable) {
            return back()->withErrors(['colocable_codigo' => 'No se encontró el colocable con el código especificado.'])->withInput();
        }

        $dispositivo->fill([
            'codigo' => $validated['codigo'],
            'nombre' => $validated['nombre'],
            'colocable_type' => $validated['colocable_type'],
            'colocable_id' => $colocable->id
        ]);

        $dispositivo->save();
        session()->flash('exito', 'Dispositivo modificado correctamente.');
        return redirect()->route('dispositivos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dispositivo $dispositivo)
    {
        $dispositivo->delete();
        return redirect()->route('dispositivos.index');
    }
}
