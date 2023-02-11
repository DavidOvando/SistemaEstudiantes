<?php

namespace App\Http\Controllers;

use App\Models\estudiantes;
use Illuminate\Http\Request;

class estudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes= estudiantes::all();
        return response() ->json($estudiantes);
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
        $estudiante = estudiantes::create($request->post());
        return response()->json([
            'estudiante'=>$estudiante
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($grupo)
    {   
        $estudiante = estudiantes::where('grupo',  $grupo)->get();
        return response()->json($estudiante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(estudiantes $estudiante)
    {
        return response()->json($estudiante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estudiantes $estudiante)
    {
        $estudiante->fill($request->post())->save();
        return response()->json([
            'estudiante'=>$estudiante
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(estudiantes $estudiante)
    {
        $estudiante->delete();
        return response()->json([
            'mensaje'=>'estudiante eliminado'
        ]);
    }
}
