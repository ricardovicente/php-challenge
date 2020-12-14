<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Uuid;

class PersonPhone extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'person_id',
        'number'
    ];

    public function person()
    {
        return $this->BelongsTo(Person::class);
    }
}
