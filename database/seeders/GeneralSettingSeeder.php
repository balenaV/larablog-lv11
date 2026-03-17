<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::create([
            'site_title'=>'devBlog',
            'site_email'=>'devblog@gmail.com',
            'site_phone'=>'5544984563700',
            'site_meta_keywords'=>'laravel, blog, dev',
            'site_meta_description'=>'',
            'site_logo'=>'default_logo.png',
            'site_favicon'=>''
        ]);
    }
}
