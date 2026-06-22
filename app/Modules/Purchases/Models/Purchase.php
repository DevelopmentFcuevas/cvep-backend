<?php
namespace App\Modules\Purchases\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\People\Models\Proveedor;
use App\Modules\Purchases\Models\PurchaseDetail;

class Purchase extends Model
{
    const BORRADOR = 'BORRADOR';
    const CONFIRMADO = 'CONFIRMADO';
    const ANULADO = 'ANULADO';


    protected $table = 'purchases.purchase';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'proveedor_id',
        'fecha',
        'total',
        'estado',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_id');
    }

    public function canBeEdited(): bool
    {
        return $this->estado === self::BORRADOR;
    }
    
}