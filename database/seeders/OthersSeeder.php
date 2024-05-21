<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Chart;
use App\Models\Logo;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OthersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chart::create([
            'title' => 'Congratulations',
            'desc' => '...',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        About::create([
            'title' => 'Title',
            'desc' => 'Description',
            'address' => 'Address',
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd',
            'video' => 'video.mov',
            'telegram_account' => null,
            'instagram' => null,
            'facebook' => null,
            'phone_number' => '+998901234567',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Logo::create([
            'title' => 'English with Begov',
            'image' => 'image.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
