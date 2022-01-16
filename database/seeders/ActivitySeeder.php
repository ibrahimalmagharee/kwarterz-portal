<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                'title' => 'أبدا قوة الرسم في الإنجاز',
                'subtitle' => 'أبدا قوة الرسم في الإنجاز',
                'description' =>'فيروسات كورونا البشرية شائعة وترتبط عادةً بأمراض خفيفة ، على غرار نزلات البرد. نحن وكالة رقمية.',
                'date' => now()->addYear(),
                'category_id' =>1,
                'slug' =>3,
                'user_id' =>1
            ],
            [
                'title' => 'أنت تعمل في طريقك إلى التفكير الإبداعي',
                'subtitle' => 'أبدا قوة الرسم في الإنجاز',
                'description' =>'فيروسات كورونا البشرية شائعة وترتبط عادةً بأمراض خفيفة ، على غرار نزلات البرد. نحن وكالة رقمية.',
                'date' => now()->addYear(),
                'category_id' =>2,
                'slug' =>3,
                'user_id' =>1
            ],
            [
                'title' => 'أن تكون مبدعًا ضمن قيود ملخصات العميل',
                'subtitle' => 'أبدا قوة الرسم في الإنجاز',
                'description' =>'فيروسات كورونا البشرية شائعة وترتبط عادةً بأمراض خفيفة ، على غرار نزلات البرد. نحن وكالة رقمية.',
                'date' => now()->addYear(),
                'category_id' =>3,
                'slug' =>3,
                'user_id' =>1
            ]

        ];
        $index = 1;
        foreach($activities as $activity){
            $separator = '-';
            $activity['slug'] = trim($activity['title']);
            $activity['slug'] = mb_strtolower( $activity['title'], "UTF-8");;
            $activity['slug'] = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "",  $activity['title']);
             $activity['slug'] = preg_replace("/[\s-]+/", " ",  $activity['title']);
             $activity['slug'] = preg_replace("/[\s_]/", $separator,  $activity['title']);
            $act = Activity::create($activity);
            $image = Image::create([
                'name' =>'blog-'.$index.'.jpg'
            ]);
            $act->image()->save($image);
            $index++;
        }
    }
}
