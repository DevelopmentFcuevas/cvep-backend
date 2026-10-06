<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @description Modelo de unidad de medida.
 * Las unidades de medida son las diferentes medidas 
 * que se utilizan para medir los productos. Por ejemplo: kg, lb, 
 * mt, ml, etc. Cada unidad de medida tiene un nombre y un estado, 
 * ademas de tener un identificador unico.
 * @author Francisco Cuevas
 * @category Inventory
 * @package App\Modules\Inventory\Models
 */
class UnidadMedida extends Model
{
    use SoftDeletes;
    protected $table = 'inventory.unidad_medida';

    protected $primaryKey = 'id';
    
    /**
     * @description Lista de campos permitidos para asignación masiva.
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'sigla',
        'decimal',
        'estado',
    ];

}
