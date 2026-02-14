<?php
namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFamily extends Model
{
    protected $table = 'inventory.familia_producto';

    protected $primaryKey = 'id';
    //protected $primaryKey = 'id_familia';
    
    //public $timestamps = false;
    
    protected $fillable = [
        'nombre',
    ];

}
