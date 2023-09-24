<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the assign_room for the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assign_rooms(): HasMany
    {
        return $this->hasMany(BookingRoomList::class, 'booking_id', 'id');
    }
}
