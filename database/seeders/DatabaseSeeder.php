<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\TwodList;
use App\Models\TwodTime;
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
                'name' =>'System',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name' =>'2D Branch',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'id' => 3,
                'name' =>'Testing Branch',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
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
                'name'  =>'thurein',
                'password' => Hash::make('thu!@#098'),
                'phone'   => '0934050',
                'status' => 1,
                'break' => 5000,
                'role_id'  => 1,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'superadmin',
                'password' => Hash::make('kosoe!@#098'),
                'phone'   => '092521',
                'status' => 1,
                'break' => 3000,
                'role_id'  => 2,
                'branch_id' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'moderator1',
                'password' => Hash::make('moderator1!@#473'),
                'phone'   => '094450',
                'status' => 1,
                'break' => 50000,
                'role_id'  => 3,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'moderator2',
                'password' => Hash::make('moderator2!@#543'),
                'phone'   => '094450',
                'status' => 1,
                'break' => 50000,
                'role_id'  => 3,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'moderator3',
                'password' => Hash::make('moderator3!@#142'),
                'phone'   => '094450',
                'status' => 1,
                'break' => 50000,
                'role_id'  => 3,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'moderator4',
                'password' => Hash::make('moderator4!@#564'),
                'phone'   => '094450',
                'status' => 1,
                'break' => 50000,
                'role_id'  => 3,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'moderator5',
                'password' => Hash::make('moderator5!@#123'),
                'phone'   => '094450',
                'status' => 1,
                'break' => 50000,
                'role_id'  => 3,
                'branch_id' => 2,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name'  =>'testingadmin',
                'password' => Hash::make('test22655!@#'),
                'phone'   => '0934050',
                'status' => 1,
                'break' => 5000,
                'role_id'  => 1,
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
            $count = TwodList::where("number",$twodlist)->count();
            if($count < 1)
            {
                $row= array("number"=>$twodlist);
                TwodList::insert($row);
            }
        }
        $times =array(
            array(
                'name' =>'12:01',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'name' =>'16:30',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            )            
        );
        foreach ($times as $time) {
            $count = TwodTime::where("name",$time["name"])->count();
            if($count < 1)
            {
                TwodTime::insert($time);
            }
        }
    }
}
