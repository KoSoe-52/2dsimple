<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches =array(
            array(
                'name' =>'branch1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            
            array(
                'name' =>'branch2',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'branch3',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            )
            
        );
        //$chunks = array_chunk($userData, 500);
        foreach ($branches as $branch) {
            Branch::insert($branch);
        }
            
    }
}
