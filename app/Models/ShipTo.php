<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Uuid;

class ShipTo extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'ship_order_id',
        'name',
        'address',
        'city',
        'country'
    ];

    public function ship_order()
    {
        return $this->BelongsTo(ShipOrder::class);
    }
}
