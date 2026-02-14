<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUdM extends Model
{
    protected $table = 'inventory.producto_udm';

    protected $primaryKey = 'id';
    
    //public $timestamps = false;
    
    protected $fillable = [
        'producto_id',
        'unidad_medida_id',
        'precio_compra',
        'precio_venta',
    ];

    public function unidadMedida() {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
    }

    //VERIFICAR ESTA FUNCION
    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

}
