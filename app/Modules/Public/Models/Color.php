<?php

namespace App\Modules\Public\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author Francisco Cuevas
 * @description Modelo para la tabla colores.
 * @category Public
 * @package App\Modules\Public\Models
 */
class Color extends Model
{
    // Utiliza la eliminación suave.
    use SoftDeletes;
    
    // Nombre de la tabla.
    protected $table = 'public.colores';
    
    // Clave primaria.
    protected $primaryKey = 'id';

    // Campos que se pueden asignar masivamente.
    protected $fillable = [
        'nombre',
        'codigo_color',
        'estado',
    ];

    // Campos ocultos.
    // Se utiliza para que los campos no se muestren en la salida JSON.
    protected $hidden = ['deleted_at'];
}
