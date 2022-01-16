<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socials = [
            [
               'name'=>'فيسبوك',
               'link'=>'https://www.facebook.com/',
            ],
            [
               'name'=>'انستغرام',
               'link'=>'https://www.instagram.com/',
            ],
            [
                'name'=>'تويتر',
                'link'=>'https://twitter.com/',
             ],
        ];
        $index = 0;
        foreach ($socials as $key => $social) {
            $social = Social::create($social);
        }
    }
}
