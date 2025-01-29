<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdenadorRequest;
use App\Http\Requests\UpdateOrdenadorRequest;
use App\Models\Aula;
use App\Models\Cambio;
use App\Models\Ordenador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ordenadores.index', [
            'ordenadores' => Ordenador::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordenadores.create',[
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|unique:ordenadores,codigo',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'aula_id' => 'required|integer|exists:aulas,id',
        ]);

        $ordenador = Ordenador::create($validated);
        session()->flash('exito', 'Ordenador creado correctamente.');
        return redirect()->route('ordenadores.show', $ordenador);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordenador $ordenador)
    {
        return view('ordenadores.show', [
            'ordenador' => $ordenador,
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordenador $ordenador)
    {
        return view('ordenadores.edit',[
            'ordenador' => $ordenador,
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordenador $ordenador)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                Rule::unique('ordenadores')->ignore($ordenador),
            ],
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'aula_id' => 'required|integer|exists:aulas,id',
        ]);

        //$cambio = new Cambio($ordenador->id, $ordenador->aula_id, $validated['aula_id']);

        if ($request->input('aula_id') != $ordenador->aula_id) {
            $destino = Aula::findOrFail($request->input('aula_id'))->id;
            $cambio = new Cambio();
            $cambio->ordenador_id = $ordenador->id;  //$cambio->ordenador()->associate($ordenador) Asi es mejor porque nos olvidamos de nombres de claves ajenas
            $cambio->origen_id = $ordenador->aula_id;
            $cambio->destino_id = $destino;
            $cambio->save();
        }

        $ordenador->fill($validated);
        $ordenador->save();

        session()->flash('exito', 'Ordenador modificado correctamente.');
        return redirect()->route('ordenadores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordenador $ordenador)
    {
        $ordenador->delete();
        return redirect()->route('ordenadores.index');
    }
}
