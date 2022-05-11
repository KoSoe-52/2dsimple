@extends('layouts.master')
@section('title','ကိုယ်စားလှယ်များ')
@section('header')
    <div class="col-5 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">User List</h4>
        <!-- <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Apps</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">User List</li>
                </ol>
            </nav>
        </div> -->
    </div>
    <div class="col-1 align-self-center">
        
    </div>
    <div class="col-6 align-self-center">
        <div class="customize-input float-right">
            <button data-toggle="modal" data-target="#create_user_modal" class="custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                CREATE NEW <i class="fa fa-plus text-success"></i>
            </button>
        </div>
    </div>
    @if(session('status'))
        <div class="offset-lg-4 col-lg-4 alert alert-success p-2">{{session('status')}}</div>
    @endif
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Break</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Edit/Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($users) > 0)
                        @foreach($users as $key=>$user)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->phone}}</td>
                            <td class='text-danger'>{{$user->break}}</td>
                            <td>{{$user->created_at}}</td>                            
                            @if($user->status == 1)
                                <td class='text-success'>Active-User</td>
                            @else
                                <td class="text-danger">Inactive-User</td>
                            @endif                            
                            <td>
                                <button class="btn btn-primary"><a href="{{url('/users/'.$user->id)}}"  class="text-white" ><i class="fa fa-edit"></i> Edit </a> </button>
                                <button class="btn btn-danger"><a href="#" data-id="{{$user->id}}" class="text-white user-delete"><i class="fa fa-times"></i> Delete </a></button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" style="text-align:center">There is no user</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
<!--create modal --->
<div class="modal" id="create_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-info" id="createLabgroupLabel">CREATE USER</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-0 pt-0">
                        <label for="name" class="col-form-label pt-0">Name<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" autocomplete="off" style="background:#eee" name="name" id="name" required />
                    </div>
                    <div class="form-group mt-0 pt-0">
                        <label for="phone" class="col-form-label pt-0">Mobile number<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" autocomplete="off" style="background:#eee" name="phone" id="phone" required />
                    </div>
                    <div class="form-group mt-0 pt-0">
                        <label for="status" class="col-form-label pt-0">Status<b class="text-danger">*</b></label>
                        <select name="status" id="status" style="background:#eee" class="form-control" >
                            <option value="">---Select-status---</option>
                            <option value="1" >Active-User</option>
                            <option value="2">Inactive-User</option>
                        </select>
                    </div>
                    <div class="form-group mt-0 pt-0">
                        <label for="break" class="col-form-label pt-0">Break<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" autocomplete= "off" style="background:#eee" name="break" id="break" required />
                    </div>
                    
                    <div class="form-group mt-0 pt-0">
                        <label for="password" class="col-form-label pt-0">Password<b class="text-danger">*</b></label>
                        <input type="password" class="form-control" autocomplete="off" style="background:#eee" name="password" id="password" required />
                    </div>
                    <!-- <div class="form-group mt-0 pt-0 row">
                        <div class="col-md-4">
                            <input type="radio" value="1" name="role" id="admin" required>
                            <label for="admin" class="col-form-label">Admin </label>
                        </div>
                        <div class="col-md-4">
                            <input type="radio" value="2" name="role" id="superadmin" required>
                            <label for="superadmin" class="col-form-label">Super Admin </label>
                        </div>
                        <div class="col-md-4">
                            <input type="radio" value="3" name="role" id="moderator" required>
                            <label for="moderator" class="col-form-label">User </label>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary "><i class="fa fa-paper-plane"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section("script")
    <script>
        var baseUrl = '{{url("admin/users")}}';
        $(document).ready(function(){
            $(document).on("click",".user-delete",function(){
                var id = $(this).data("id");
                var conf = confirm("Are  you sure want to delete?");
                if(conf ==  true)
                {
                    $.ajax({
                        url: baseUrl+'/delete/'+id,
                       // url: {{url("Auth::user()->roles->name.")}}'/users/delete/'+id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                          },
                        cache:false,
                        processData:false,
                        contentType:false,
                        success:function(response)
                        {
                            if(response.status == true)
                            {
                                alert(response.msg);
                                window.location.href=baseUrl;
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection