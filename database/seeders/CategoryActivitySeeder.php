<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryActivitySeeder extends Seeder
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
                    'name' => 'أسلوب الحياة',
                    'type' => 'activity',
                    'user_id' =>1
                ],
                [
                    'name' => 'السفر ',
                    'type' => 'activity',
                    'user_id' =>1
                ],
                [
                    'name' => 'التصميم',
                    'type' => 'activity',
                    'user_id' =>1
                ],
            ];
           foreach($categories as $category){
               Category::create($category);
           } 
    }
}
