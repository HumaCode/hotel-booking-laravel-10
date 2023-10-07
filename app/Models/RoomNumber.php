<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoomNumber extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the room_type that owns the RoomNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room_type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }

    /**
     * Get the last_booking associated with the RoomNumber
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function last_booking(): HasOne
    {
        return $this->hasOne(BookingRoomList::class, 'room_number_id', 'id')->latest();
    }
}
