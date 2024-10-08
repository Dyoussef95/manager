<?php

namespace App\Http\Controllers;

use App\Models\EnteOrganismo;
use Illuminate\Http\Request;

class EnteOrganismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entes = EnteOrganismo::all()->sortBy('name');
         return view('administracion.entes.index')
                ->with('entes', $entes);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.entes.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:enteorganismo'],
        ]);

        $ente = EnteOrganismo::create([
            'name' => $request->name,
        ]);

        return redirect()->route('entes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnteOrganismo  $enteOrganismo
     * @return \Illuminate\Http\Response
     */
    public function show(EnteOrganismo $enteOrganismo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnteOrganismo  $enteOrganismo
     * @return \Illuminate\Http\Response
     */
    public function edit(EnteOrganismo $ente)
    {
        return view('administracion.entes.edit')
        ->with('ente',$ente);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnteOrganismo  $enteOrganismo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnteOrganismo $ente)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:enteorganismo'],
        ]);

        $ente->name= $request->name;
        $ente->save();

        return redirect()->route('entes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnteOrganismo  $enteOrganismo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnteOrganismo $ente)
    {
        $ente->delete();
        return redirect()->route('entes.index');
    }
}
