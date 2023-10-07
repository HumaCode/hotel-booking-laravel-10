<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingRoomList extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the room_number that owns the BookingRoomList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room_number(): BelongsTo
    {
        return $this->belongsTo(RoomNumber::class, 'room_number_id');
    }

    /**
     * Get the booking that owns the BookingRoomList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
