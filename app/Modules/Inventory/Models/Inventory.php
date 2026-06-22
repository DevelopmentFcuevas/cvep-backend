<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory.inventario';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'producto_id',
        'existencia_actual',
    ];

}
