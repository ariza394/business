<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //leer rutas por slug y no id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //relacion 1:n categoria/establecimientos
    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }
}
