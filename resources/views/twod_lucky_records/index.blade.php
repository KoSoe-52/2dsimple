@extends('layouts.master')
@section('title','ကိုယ်စားလှယ်များ')
@section('header')
    <div class="col-5 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-normal mb-3">ထိုးထားသည့်စာရင်းများ</h4>
    </div>
    <div class="col-1 align-self-center">
        
    </div>
    <div class="col-6 align-self-center">
        <div class="customize-input float-right" style="margin-right:5px;">
            <button  class=" form-control bg-success border-0 custom-shadow custom-radius text-white">
               <a href="{{url(Auth::user()->roles->name.'/alluserExport')}}" class='text-white'>Excel-Export <i class="fa fa-file-excel text-white"></i></a>
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
                        <th>ဂဏန်း</th>
                        <th>ရက်စွဲ</th>
                        <th>အချိန်</th>
                        <th>ပမာဏ</th>
                        <th>ထိုးသူအမည်</th>
                        <th>ကိုယ်စားလှယ်အမည်</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$record->number}}</td>
                            <td>{{date('d-m-Y',strtotime($record->date))}}</td>
                            <td>{{$record->time}}</td>
                            <td>{{$record->price}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->users->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$records->links()}}
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