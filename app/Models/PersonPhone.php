<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'number'
    ];

    public function person()
    {
        return $this->BelongsTo(Person::class);
    }
}
