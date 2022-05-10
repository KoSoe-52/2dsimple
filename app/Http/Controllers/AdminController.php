<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboards.admin.index');
    }
    public function showUsers()
    {
        $roles= Role::all();
        $branches= Branch::all();
        $users = User::paginate(10);
        return  view("users.index",compact('users','roles','branches'));

    }
    public function storeUsers(Request $request)
    {
        $users = User::create([
            "name" => $request->get("name"),
            "password" => Hash::make($request->get("password")),
            "phone" => $request->get("phone"),
            "status" => $request->get("status"),
            "break" => $request->get("break"),            
            "role_id" => $request->get("role_id"),
            "branch_id" => $request->get("branch_id")            
        ]);
        return redirect(Auth::user()->roles->name."/users")->with("status","Successfully created New_user");
    }
    public function editUsers($user_id)
    {
        $roles=Role::all();
        $branches=Branch::all();
        $users = User::whereId($user_id)->get();
        return  view("users.userEdit",compact('users','roles','branches'));
    }
    public function updateUsers(Request $request, $update_id)
    {
        $users=User::whereId($update_id)->firstOrFail();
        $users->name= $request->get('name');
        if(empty($request->get("password")))
        {
            $users->password = $users->password;
        }else
        {
            $users->password= Hash::make($request->get('password'));
        }
        $users->phone= $request->get('phone');
        $users->status= $request->get('status');
        $users->break= $request->get('break');
        $users->role_id= $request->get('role_id');
        $users->branch_id= $request->get('branch_id');        
        $users->update();
        return redirect()->action([AdminController::class,'editUsers'], ['id' => $update_id])
        ->with("status","Successfully updated!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
