<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory.inventario';

    protected $primaryKey = 'id';
    
    //public $timestamps = false;
    
    protected $fillable = [
        'producto_id',
        'existencia_actual',
    ];

}
