<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ordinance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function legislation(): MorphOne
    {
        return $this->morphOne(Legislation::class, 'legislable');
    }

    public function record_type(): HasOne
    {
        return $this->hasOne(Type::class, 'id', 'type');
    }

    public function author_information(): HasOne
    {
        return $this->hasOne(SanggunianMember::class, 'id', 'author');
    }

    public function co_author_information()
    {
        return $this->hasOne(SanggunianMember::class, 'id', 'co_author');
    }
}
