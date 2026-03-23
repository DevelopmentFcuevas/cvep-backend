<?php

namespace App\Modules\People\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'contacts.cliente';

    protected $primaryKey = 'id';
    
    //public $timestamps = false;
    
    protected $fillable = [
        'persona_id',
        'nombre_contacto',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
