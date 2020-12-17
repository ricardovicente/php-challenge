<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'person_id',
        'original_id'
    ];

    public function file()
    {
        return $this->BelongsTo(File::class);
    }

    public function person()
    {
        return $this->BelongsTo(Person::class);
    }

    public function ship_to()
    {
        return $this->HasMany(ShipTo::class);
    }

    public function ship_item()
    {
        return $this->HasMany(ShipItem::class);
    }
}
