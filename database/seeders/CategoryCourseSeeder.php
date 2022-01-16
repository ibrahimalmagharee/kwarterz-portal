<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CategoryCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Bootstrap',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'HTML ',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'Jquery',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'Sass',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'React',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'JAVA',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'Python',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'Mongodb ',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'Designer',
                'type' => 'course',
                'user_id' =>1
            ],
            [
                'name' => 'Designer ',
                'type' => 'course',
                'user_id' =>1
            ],
        ];
        $index = 1;
       foreach($categories as $category){
          $cat =  Category::create($category);
           $image = Image::create([
            'name' =>'download'.$index.'.png'
           ]);
            $cat->image()->save($image);
            $index++;
       }
    }
}
