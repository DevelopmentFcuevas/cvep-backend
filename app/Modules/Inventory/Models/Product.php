<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'inventory.producto';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
        'marca',
        'descripcion',
        'color',
        'pais_origen',
        'porcentaje_iva',
        'familia_producto_id',
        'unidad_medida_id',
    ];

    public function family()
    {
        return $this->belongsTo(ProductFamily::class, 'familia_producto_id');
    }

    public function unidadMedida()
    {
        return $this->hasMany(ProductUdM::class, 'producto_id');
    }

    public function inventory() {
        return $this->hasOne(Inventory::class,'producto_id');
    }

}
