<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'sadmin@gmail.com',
                'user_name' => 'sdmin',
                'phone' => '01915464958',
                'is_admin' => '1',
                'password' => bcrypt('123456'),
                'status' => '1',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'user_name' => 'admin',
                'phone' => '01811591944',
                'is_admin' => '0',
                'password' => bcrypt('123456'),
                'status' => '1',
            ],
        ];

        foreach ($users as $key => $row) {
//            User::create($row);
        }
    }
}
