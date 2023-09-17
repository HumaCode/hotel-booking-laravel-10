<?php

namespace Database\Seeders;

use App\Models\BookArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookArea::create(
            [
                'short_title'   => "MAKE A QUICK BOOKING",
                'main_title'    => "We Are the Best in All-time & So Please Get a Quick Booking",
                'short_desc'    => "Atoli is one of the best resorts in the global market and that's why you will get a luxury life period on the global market. We always provide you a special support for all of our guests and that's will be the main reason to be the most popular.",
                'created_at'    => date('Y-m-d H:i:s', time()),
                'updated_at'    => date('Y-m-d H:i:s', time()),
            ],
        );
    }
}
