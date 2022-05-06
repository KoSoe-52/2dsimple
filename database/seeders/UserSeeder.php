<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =array(
            array(
                'name'  =>'admin',
                'password' => Hash::make('password'),
                'phone'   => '0934050',
                'status' => 1,
                'break' => 5000,
                'role_id'  => 1,
                'branch_id' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'superadmin',
                'password' => Hash::make('password'),
                'phone'   => '092521',
                'status' => 1,
                'break' => 3000,
                'role_id'  => 2,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'moderator',
                'password' => Hash::make('password'),
                'phone'   => '094450',
                'status' => 1,
                'break' => 1000,
                'role_id'  => 3,
                'branch_id' => 3,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
        );
        foreach ($users as $user) {
            User::insert($user);
        }
    }
}
