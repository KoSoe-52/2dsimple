<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =array(
            array(
                'name' =>'Admin',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            
            array(
                'name' =>'SuperAdmin',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'Moderator',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            )
            
        );
        //$chunks = array_chunk($userData, 500);
        foreach ($roles as $role) {
            Role::insert($role);
        }
    }
}
