<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShipItem extends Model
{
    use HasFactory;

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

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }
}
