<?php

namespace App\Modules\People\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\People\Models\Cliente;
use App\Modules\People\Models\Proveedor;
use App\Modules\People\Models\Telefono;

class Persona extends Model
{
    protected $table = 'contacts.persona';

    protected $primaryKey = 'id';
    
    //public $timestamps = false;
    
    protected $fillable = [
        'nombre_razon_social',
        'ruc',
        'direccion',
        'ciudad',
        'descripcion_ubicacion',
        'estado',
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'persona_id');
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class, 'persona_id');
    }

    public function telefonos()
    {
        return $this->hasMany(Telefono::class, 'persona_id');
    }
}
