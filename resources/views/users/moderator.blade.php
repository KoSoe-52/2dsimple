@extends('layouts.master')
@section('title','Category list')
@section('header')
    <div class="col-5 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">User List</h4>
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Apps</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">User List</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-3 align-self-center">
        <div class="customize-input float-right">
            <button  class=" form-control bg-success border-0 custom-shadow custom-radius text-white">
               <a href="{{url(Auth::user()->roles->name.'/allmoderatorExport')}}" class='text-white'>Excel-Export <i class="fa fa-file text-white"></i></a>
            </button>
        </div>
    </div>
    <div class="col-4 align-self-center">
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
                        <th>Role</th>
                        <th>Username</th>
                        <th>Activation</th>
                        <th>Created at</th>
                    @if(Auth::user()->name=="admin")
                        <th>Edit/Delete</th>
                    @elseif(Auth::user()->name!="admin")
                        <th>Edit</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @if(count($users) > 0)
                        @foreach($users as $key=>$user)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->roles->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                                @if($user->activation == 1)
                                    Active user
                                @else
                                    Inactive user
                                @endif
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <button class="btn btn-primary"><a href="{{url(Auth::user()->roles->name.'/moderators/'.$user->id)}}"  class="text-white" ><i class="fa fa-edit"></i> Edit </a> </button>
                                @if(Auth::user()->name=="admin")
                                <button class="btn btn-danger"><a href="#" data-id="{{$user->id}}" class="text-white user-delete"><i class="fa fa-times"></i> Delete </a></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" style="text-align:center">There is no user</td>
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
                        <label for="name" class="col-form-label">Name<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" autocomplete="off" name="name" id="name" required />
                    </div>
                    <div class="form-group mt-0 pt-0">
                        <label for="phone" class="col-form-label">Mobile number<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" autocomplete="off" name="phone" id="phone" required />
                    </div>
                    <div class="form-group mt-0 pt-0">
                        <label for="username" class="col-form-label">Username<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" autocomplete="off" name="username" id="username" required />
                    </div>
                    <div class="form-group mt-0 pt-0">
                        <label for="password" class="col-form-label">Password<b class="text-danger">*</b></label>
                        <input type="password" class="form-control" autocomplete="off" name="password" id="password" required />
                    </div>
                    <div class="form-group mt-0 pt-0 row">
                        <div class="col-md-4">
                            <input type="radio" value="2" name="role" id="moderator" checked>
                            <label for="moderator" class="col-form-label">Moderator </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section("script")
    <script>
        var baseUrl = '{{url("")}}';
        $(document).ready(function(){
            $(document).on("click",".user-delete",function(){
                var id = $(this).data("id");
                var conf = confirm("Are  you sure want to delete?");
                if(conf ==  true)
                {
                    $.ajax({
                        url: baseUrl+'/moderators/delete/'+id,
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
                                window.location.href=baseUrl+"/moderators";
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection