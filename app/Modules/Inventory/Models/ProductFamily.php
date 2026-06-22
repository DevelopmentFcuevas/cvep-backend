<?php
namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Francisco Cuevas
 * @description Modelo de familia de productos. 
 * Los productos se agrupan por familias para facilitar su 
 * administración. Por ejemplo: suministros, útiles, tintas, 
 * repuestos, accesorios, etc.
 * @category Inventory
 * @package App\Modules\Inventory\Models
 */

class ProductFamily extends Model
{
    protected $table = 'inventory.familia_producto';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
    ];

}
