<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = \App\Models\Libro::get();
        return response()->json([
            'msg' => 'Success', 
            'libros' => $libros->toArray()
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $libro = new \App\Models\Libro();
        $libro->nombre = $request->nombre;
        $libro->descripcion = $request->descripcion;
        $libro->save();
        return response()->json([
            'msg' => 'Success', 
            'id' => $libro->id_libro
            ], 200);
        /*\App\Models\Libro::create([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            
            ]);
            return "Usuario registrado";*/
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = \App\Models\Libro::find($id);
        return response()->json([
            'msg' => 'Success', 
            'libros' => $libro
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $libro = \App\Models\Libro::find($id);

        $libro->nombre = $request->nombre;
        $libro->descripcion = $request->descripcion;
        $libro->save();
        return response()->json([
            'msg' => 'Success'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
