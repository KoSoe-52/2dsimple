<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\TwodList;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
            $count = Branch::where("name",$branch["name"])->count();
            if($count < 1)
            {
                Branch::insert($branch);
            }
        }
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
            $count = Role::where("name",$role["name"])->count();
            if($count < 1)
            {
                Role::insert($role);
            }
        }
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
            $count = User::where("name",$user["name"])->count();
            if($count < 1)
            {
                User::insert($user);
            }
        }
        //twod list
        $twodlists =array(
            "00","01","02","03","04","05","06","07","08","09",
            "10","11","12","13","14","15","16","17","18","19",
            "20","21","22","23","24","25","26","27","28","29",
            "30","31","32","33","34","35","36","37","38","39",
            "40","41","42","43","44","45","46","47","48","49",
            "50","51","52","53","54","55","56","57","58","59",
            "60","61","62","63","64","65","66","67","68","69",
            "70","71","72","73","74","75","76","77","78","79",
            "80","81","82","83","84","85","86","87","88","89",
            "90","91","92","93","94","95","96","97","98","99"
        );
        foreach ($twodlists as $twodlist) {
            $count = TwodList::where("name",$twodlist)->count();
            if($count < 1)
            {
                $row= array("name"=>$twodlist);
                TwodList::insert($row);
            }
        }
    }
}
