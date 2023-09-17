<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class, 'roomtype_id', 'id');
    }
}
