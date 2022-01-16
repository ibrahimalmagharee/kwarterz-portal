<?php

namespace Database\Seeders;

use App\Models\RegisterFormInterest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CreateUsersSeeder::class);
        $this->call(CategoryActivitySeeder::class);
        $this->call(CategoryCourseSeeder::class);
        // $this->call(ActivitySeeder::class);
        $this->call(SocialSeeder::class);

        $interests = [
            ['name' => 'دبلوم الصحافة والإعلام'],
            ['name' => 'دبلوم الإعلام الرقمي'],
            ['name' => 'دبلوم التسويق الالكتروني'],
            ['name' => 'دبلوم التصميم الجراقيكي'],
            ['name' => 'دبلوم ادارة المستشفيات'],
            ['name' => 'دبلوم إدارة الموارد البشرية'],
            ['name' => 'ماجستير ادارة الأعمال المهني المصغر'],
            ['name' => 'ماجستير ادارة الموارد البشرية المهني المصغر'],
            ['name' => 'ماجستير الاعلام الرقمي المهني المصغر'],
        ];

        foreach($interests as $interest){
            RegisterFormInterest::create([
                'name' => $interest['name']
            ]);
        }
    }
}
