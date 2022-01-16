<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'Admin',
                'email'=>'admin@quartter.com',
                'is_admin'=>'1',
                'national' => 'فلسطيني',
                'mobile_number' => '0592890200',
                'password'=> bcrypt('123456'),
                'user_id' =>1
            ],
            [
                'name'=>'User',
                'email'=>'user@quartter.com',
                'national' => 'أردني',
                'mobile_number' => '0592890201',
                'is_admin'=>'0',
                'password'=> bcrypt('123456'),
                'user_id' =>1
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
