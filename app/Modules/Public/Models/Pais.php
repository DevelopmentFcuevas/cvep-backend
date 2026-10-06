<?php

namespace App\Modules\Public\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author Francisco Cuevas
 * @description Modelo para la tabla paises.
 * @category Public
 * @package App\Modules\Public\Models
 */
class Pais extends Model
{
    // Utiliza la eliminación suave.
    use SoftDeletes;

    // Nombre de la tabla.
    protected $table = 'public.paises';

    // Campos que se pueden asignar masivamente.
    protected $fillable = [
        'nombre',
        'nacionalidad',
        'cod_iso_2',
        'cod_iso_3',
        'prefijo_telefonico',
        'estado',
    ];
    
    // Casting de tipos.
    // Se utiliza para que los campos se conviertan a tipos de datos específicos.
    protected $casts = [
        'estado' => 'boolean',
    ];

    // Campos ocultos.
    // Se utiliza para que los campos no se muestren en la salida JSON.
    protected $hidden = [
        'deleted_at',
    ];
}
