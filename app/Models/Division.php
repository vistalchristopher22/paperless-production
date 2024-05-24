<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function board_member()
    {
        return $this->hasOne(SanggunianMember::class, 'id', 'board');
    }
}
