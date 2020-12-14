<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Uuid;

class File extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'user_id',
        'original_name',
        'stored_path',
        'size',
        'records',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function person()
    {
        return $this->HasMany(Person::class);
    }

    public function ship_order()
    {
        return $this->HasMany(ShipOrder::class);
    }
}
