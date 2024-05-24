<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legislation extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function legislable()
    {
        return $this->morphTo();
    }

    public function sponsors()
    {
        return $this->belongsToMany(SanggunianMember::class, 'legislation_sponsors', 'legislation_id', 'sanggunian_member_id')->withTimestamps();
    }
}
