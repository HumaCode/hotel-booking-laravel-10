<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'roomtype_id', 'id');
    }

    public function multiimage(): HasMany
    {
        return $this->hasMany(MultiImage::class, 'rooms_id', 'id');
    }

    public function facility(): HasMany
    {
        return $this->hasMany(Facility::class, 'rooms_id', 'id');
    }
}
