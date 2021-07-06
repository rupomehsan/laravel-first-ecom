<?php

namespace Database\Seeders;
use App\Models\Sitesetting;
use Illuminate\Database\Seeder;

class SitesettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sitesetting::truncate();
        Sitesetting::create([
            'title' => 'Rupom Ehsan',
            'logo'  => 'uploads/imageone',
            'email' => 'Rupomehsan@gmail.com',
            'phone' => '01683392241',
            'copyright' => 'rupomehsan@copyright reserved',
            'address' => 'basundra river view',
            'fb_link' => 'http/facebook.com',
            'twitter_link' => 'http/twitter.com',
            'youtube_link' => 'http/youtube.com'
        ]);
    }
}
