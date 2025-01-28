<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAulaRequest;
use App\Http\Requests\UpdateAulaRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Aula;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aulas.index', [
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aulas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|unique:aulas,codigo',
            'nombre' => 'required|string'
        ]);

        $aula = Aula::create($validated);
        session()->flash('exito', 'Aula creada correctamente.');
        return redirect()->route('aulas.show', $aula);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        return view('aulas.show', [
            'aula' => $aula,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        return view('aulas.edit',[
            'aula' => $aula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aula $aula)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                Rule::unique('aulas')->ignore($aula),
            ],
            'nombre' => 'required|string'
        ]);

        $aula->fill($validated);
        $aula->save();
        session()->flash('exito', 'Aula modificado correctamente.');
        return redirect()->route('aulas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('aulas.index');
    }
}
