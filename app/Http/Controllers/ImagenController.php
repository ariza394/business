<?php

namespace App\Http\Controllers;

use App\Establecimiento;
use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {   
        //ruta imagen
        $ruta_imagen = $request->file('file')->store('establecimientos','public');

        //resize imagen
        //$imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800,450);
        $imagen = $request->file('file');
        $imagen->save();

        //almacena en la db
        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen =$ruta_imagen;
        $imagenDB->save();

        //return
        $respuesta = [
            'archivo' => $ruta_imagen
        ];

        return response()->json($respuesta);
    }

    public function destroy(Request $request)
    {   
        $uuid = $request->get('uuid');
        $establecimiento = Establecimiento::where('uuid',$uuid)->first();
        $this->authorize('delete',$establecimiento);
        
        $imagen = $request->get('imagen');
        
        if(File::exists('storage/' . $imagen)){

            //elimina del servidor
            File::delete('storage/' . $imagen);

            //elimina de la db
            Imagen::where('ruta_imagen',$imagen)->delete();

            $respuesta = [
                'Mensaje' => 'Imagen Eliminada',
                'Imagen' => $imagen
            ];
        }

        

        //Imagen::where('ruta_imagen', '=', $imagen)->delete();

        return response()->json($respuesta);
    }

}
