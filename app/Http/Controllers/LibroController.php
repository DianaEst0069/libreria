<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Uso del Modelo
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Obtener los datos del modelo
        $libros = Libro::all();

        //Mandamos la información a la vista del index
        return view('libros.index',compact('libros'));
    }

    /**
     * Retornar la vista del formulario
     */
    public function create()
    {
        //
        return view('libros.create');
    }

    /**
     * Guardar datos en la BD
     */
    public function store(Request $request)
    {
        //Esquema para enviar datos a la BD
        Libro::create([
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial, 
            'precio' => $request->precio, 
        ]);

        //Enviar al usuario a otra página
        return redirect()->route('libros.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Consultar información
     */
    public function edit(Libro $libro)
    {
        //Retornar vista con los datos del libro
        return view('libros.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        //Realizar validaciones de los campos del formulario
        $request ->validate([
            'nombre' => 'required', 
            'autor' => 'required',
            'editorial' => 'required',
            'precio' => 'required',

        ]);

        $libro->update($request->all());

        return redirect() -> route('libros.index')
        ->with('success', 'Actualización con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        //Eliminación del registro
        $libro -> delete();

        //Redireccionar al usuario
        return redirect() -> route('libros.index')
        -> with('success', 'Libro eliminado');
    }
}
