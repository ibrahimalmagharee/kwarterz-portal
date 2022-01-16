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
                'title' => 'أبدا قوة الرسم في الإنجاز' ,
                'description' => 'فيروسات كورونا البشرية شائعة وترتبط عادةً بأمراض خفيفة ، على غرار نزلات البرد. نحن وكالة رقمية' ,
                'date' => now()->addYear() ,
                'category_id' => 1 ,
            ],
            [
                'title' => 'أنت تعمل في طريقك إلى التفكير الإبداعي' ,
                'description' => 'فيروسات كورونا البشرية شائعة وترتبط عادةً بأمراض خفيفة ، على غرار نزلات البرد. نحن وكالة رقمية' ,
                'date' => now()->addYear() ,
                'category_id' => 2 ,
            ],
            [
                'title' => 'أن تكون مبدعًا ضمن قيود ملخصات العميل' ,
                'description' => 'فيروسات كورونا البشرية شائعة وترتبط عادةً بأمراض خفيفة ، على غرار نزلات البرد. نحن وكالة رقمية' ,
                'date' => now()->addYear() ,
                'category_id' => 3 ,
            ]
            
            
        ];
        $index = 1;
        foreach ($activities as $key => $activity) {
            $act = Activity::create($activity);
            $image = Image::create([
                'name' => 'blog-'.$index.'.jpg'
            ]);
            $act->image()->save($image);
            $index++;
        }
    }
}
