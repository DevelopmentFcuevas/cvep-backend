<?php
namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author Francisco Cuevas
 * @description Modelo de familia de productos. 
 * Los productos se agrupan por familias para facilitar su 
 * administración. Por ejemplo: suministros, útiles, tintas, 
 * repuestos, accesorios, etc.
 * @category Inventory
 * @package App\Modules\Inventory\Models
 */

class CategoriaProducto extends Model
{
    use SoftDeletes;
    //protected $table = 'inventory.familia_producto';
    protected $table = 'inventory.categoria_producto';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
    ];

}
