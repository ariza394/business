<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Establecimiento;
use App\Imagen;
use Illuminate\Http\Request;

class APIController extends Controller
{   
    //metodo para todos los establecimientos
    public function index()
    {   
        
        //$establecimientos = Establecimiento::all();
        //para cargar un -> relacion
        $establecimientos = Establecimiento::with('categoria')->get();

        return response()->json($establecimientos);
    }

    //metodo para las categorias
    public function categorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    //metodo para una categoria
    public function categoria(Categoria $categoria)
    {   
        $establecimientos = Establecimiento::where('categoria_id',$categoria->id)->with('categoria')->limit(3)->get();

        //$categoria = Categoria::all();
        return response()->json($establecimientos);
    }

    //mismo que arriba pero sin limite
    public function establecimientoscategoria(Categoria $categoria)
    {   
        $establecimientos = Establecimiento::where('categoria_id',$categoria->id)->with('categoria')->get();

        //$categoria = Categoria::all();
        return response()->json($establecimientos);
    }

    //metodo para una establecimiento
    public function show(Establecimiento $establecimiento)
    {   
        $imagenes = Imagen::where('id_establecimiento',$establecimiento->uuid)->get();
        $establecimiento->imagenes = $imagenes;

        return response()->json($establecimiento);
    }

    
}
