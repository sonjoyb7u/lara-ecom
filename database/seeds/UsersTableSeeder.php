<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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
                'name' => 'Sonjoy Barua',
                'email' => 'sonjoy@gmail.com',
                'user_name' => 'sonjoyb7u',
                'password' => bcrypt('123456'),
                'phone' => '01915464958',
                'address' => '799-1no Lane, Dhumpara, Wasa, Chittagong',
                'is_admin' => '1',
                'status' => '1',
            ],
            [
                'name' => 'Payel Barua',
                'email' => 'payel@gmail.com',
                'user_name' => 'payelb7u',
                'password' => bcrypt('123456'),
                'phone' => '01811591944',
                'is_admin' => '0',
                'address' => '799-2no Lane, Dhumpara, Wasa, Chittagong',
                'status' => '1',
            ],
        ];

        foreach ($users as $key => $row) {
            User::create($row);
        }
    }
}
