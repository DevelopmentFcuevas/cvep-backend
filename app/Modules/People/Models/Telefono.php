<?php

namespace App\Modules\People\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'contacts.telefono';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'persona_id',
        'numero',
        'tipo',
        'principal',
        'activo',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
