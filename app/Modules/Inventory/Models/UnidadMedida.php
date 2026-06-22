<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'inventory.unidad_medida';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
    ];

}
