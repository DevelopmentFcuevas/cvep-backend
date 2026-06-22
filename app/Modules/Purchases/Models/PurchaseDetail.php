<?php
namespace App\Modules\Purchases\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Purchases\Models\Purchase;
use App\Modules\Inventory\Models\Product;

class PurchaseDetail extends Model
{
    protected $table = 'purchases.purchase_detail';

    protected $primaryKey = 'id';

    protected $fillable = [
        'purchase_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'producto_id');
    }
}