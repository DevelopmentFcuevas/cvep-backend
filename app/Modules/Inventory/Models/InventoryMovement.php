<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $table = 'inventory.inventory_movements';

    protected $primaryKey = 'id';
    
    //public $timestamps = false;
    
    protected $fillable = [
        'producto_id',
        'tipo_movimiento',
        'cantidad',
        'motivo',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }
}