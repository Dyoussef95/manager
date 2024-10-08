<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubicaciones = Ubicacion::all()->sortBy('name');
         return view('administracion.ubicaciones.index')
                ->with('ubicaciones', $ubicaciones);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.ubicaciones.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:ubicacions'],
        ]);

        $ubicacione = Ubicacion::create([
            'name' => $request->name,
        ]);

        return redirect()->route('ubicaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacione)
    {
        return view('administracion.ubicaciones.edit')
                ->with('ubicacion',$ubicacione);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacione)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ubicacions'],
        ]);

        $ubicacione->name= $request->name;
        $ubicacione->save();

        return redirect()->route('ubicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacione)
    {
        $ubicacione->delete();
        return redirect()->route('ubicaciones.index');
    }
}
