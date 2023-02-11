<?php

namespace App\Http\Controllers;

use App\Models\notas;
use Illuminate\Http\Request;

class notasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas= notas::all();
        return response() ->json($notas);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nota = notas::create($request->post());
        return response()->json([
            'nota'=>$nota
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($estudiante)
    {
        $nota = notas::where('estudiante',  $estudiante)->get();
        return response()->json($nota);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(notas $nota)
    {
        return response()->json($nota);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notas $nota)
    {
        $nota->fill($request->post())->save();
        return response()->json([
            'nota'=>$nota
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(notas $nota)
    {
        $nota->delete();
        return response()->json([
            'mensaje'=>'Nota Eliminada'
        ]);
    }
}
