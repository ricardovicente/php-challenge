<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Uuid;
use Illuminate\Support\Str;

class Person extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'file_id',
        'original_id',
        'name'
    ];

    public function file()
    {
        return $this->BelongsTo(File::class);
    }

    public function person_phone()
    {
        return $this->HasMany(PersonPhone::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }
}
