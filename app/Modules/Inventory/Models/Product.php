<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Public\Models\Pais;
use App\Modules\Public\Models\Color;

class Product extends Model
{
    protected $table = 'inventory.producto';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nombre',
        'marca_id',
        'codigo_barras',
        'descripcion',
        'modelo',
        'serie',
        'notas',
        'peso',
        'volumen',
        'color_id',
        'pais_id',
        'categoria_producto_id',
        'unidad_medida_id',
        'estado',
    ];

    public function family()
    {
        return $this->belongsTo(CategoriaProducto::class, 'categoria_producto_id');
    }

    public function unidadMedida()
    {
        return $this->hasMany(ProductUdM::class, 'producto_id');
    }

    public function inventory() {
        return $this->hasOne(Inventory::class,'producto_id');
    }
    
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

}
