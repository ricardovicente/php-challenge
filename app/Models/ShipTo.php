<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShipTo extends Model
{
    use HasFactory;

    public $timestamps = false;

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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Str::title($value);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = Str::title($value);
    }

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = Str::title($value);
    }
}
