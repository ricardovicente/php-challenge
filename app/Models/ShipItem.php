<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Uuid;

class ShipItem extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'ship_order_id',
        'title',
        'note',
        'quantity',
        'price'
    ];

    public function ship_order()
    {
        return $this->BelongsTo(ShipOrder::class);
    }
}
