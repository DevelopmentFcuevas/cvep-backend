<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author Francisco Cuevas
 * @description Modelo para la tabla marcas.
 * Las marcas son importantes para la clasificación de los productos, ya 
 * que permite agruparlos por marca, lo que facilita su administración.
 * @category Inventory
 * @package App\Modules\Inventory\Models
 */
class Marca extends Model
{
    // Utiliza la eliminación suave.
    use SoftDeletes;

    // Nombre de la tabla.
    protected $table = 'inventory.marcas';

    // Primary key.
    protected $primaryKey = 'id';

    // Campos que se pueden asignar masivamente.
    protected $fillable = [
        'nombre',
        'descripcion',
        'abreviatura',
        'estado',
    ];

    // Casting de tipos.
    // Se utiliza para que los campos se conviertan a tipos de datos específicos.
    //protected $casts = [
    //    'estado' => 'boolean',
    //];

    // Campos ocultos.
    // Se utiliza para que los campos no se muestren en la salida JSON.
    protected $hidden = [
        'deleted_at',
    ];
}
