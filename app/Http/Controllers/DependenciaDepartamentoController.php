<?php

namespace App\Http\Controllers;

use App\Models\DependenciaDepartamento;
use Illuminate\Http\Request;

class DependenciaDepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependencias = DependenciaDepartamento::all()->sortBy('name');
         return view('administracion.dependencias.index')
                ->with('dependencias', $dependencias);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.dependencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:dependencia_departamentos'],
        ]);

        $dependencia = DependenciaDepartamento::create([
            'name' => $request->name,
        ]);

        return redirect()->route('dependencias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DependenciaDepartamento  $dependenciaDepartamento
     * @return \Illuminate\Http\Response
     */
    public function show(DependenciaDepartamento $dependenciaDepartamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DependenciaDepartamento  $dependenciaDepartamento
     * @return \Illuminate\Http\Response
     */
    public function edit(DependenciaDepartamento $dependencia)
    {
        return view('administracion.dependencias.edit')
                ->with('dependencia',$dependencia);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DependenciaDepartamento  $dependenciaDepartamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DependenciaDepartamento $dependencia)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:dependencia_departamentos'],
        ]);

        $dependencia->name= $request->name;
        $dependencia->save();

        return redirect()->route('dependencias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DependenciaDepartamento  $dependenciaDepartamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(DependenciaDepartamento $dependencia)
    {
        $dependencia->delete();
        return redirect()->route('dependencias.index');
    }
}
