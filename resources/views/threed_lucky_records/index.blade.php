@extends('layouts.master')
@section('title','ThreeD')
@section('header')
    <div class="col-5 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-normal mb-3">ထိုးထားသည့်စာရင်းများ</h4>
    </div>
    <div class="col-1 align-self-center">
        
    </div>
    @if(session('status'))
        <div class="offset-lg-4 col-lg-4 alert alert-success p-2">{{session('status')}}</div>
    @endif
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <form class="col-12 row">
                <div class="form-group col-md-3 col-xl-2">
                    <label for="number">ဂဏန်း</label>
                    <input type="text" class="form-control" autocomplete="off" name="number" id="number">
                </div>
                <div class="form-group col-md-3 col-xl-2">
                    <label for="date">ရက်စွဲ</label>
                    <input type="date" class="form-control" name="date" id="date" autocomplete="off">
                </div>
                <div class="form-group col-md-3 col-xl-2">
                    <label for="user_id">ကိုယ်စားလှယ်အမည်</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value=""></option>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-3 col-xl-2">
                    <label for="pricegroup">ငွေပမာဏ</label>
                    <table id="pricegroup">
                        <tr>
                            <td style="width:40%">
                                <select name="condition" id="condition" class="form-control" style="text-align:center;width:100%;">
                                    <option value=">=">>=</option>
                                    <option value="<="><=</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="price" id="price" autocomplete="off">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group col-md-3 col-xl-2">
                    <button type="submit" id="search" class="btn btn-primary mt-3">ရှာမည်</button>
                </div>
            </form>
        </div>
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
                        <th>*</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = array(); ?>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$record->number}}</td>
                            <td>{{date('d-m-Y',strtotime($record->date))}}</td>
                            <td>{{$record->inser_date_time}}</td>
                            <td>{{$record->price}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->users->name}}</td>
                           <td><button class="btn btn-danger"><a href="#" data-id="{{$record->id}}" class="text-white record_delete"><i class="fa fa-times"></i> Delete </a></button></td>
                        </tr>
                        <?php $total[]=$record->price; ?>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align:right">စုစုပေါင်း</td>
                        <td>{{array_sum($total)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section("script")
    <script>
        var baseUrl = '{{url("admin/users")}}';
        $(document).ready(function(){
            $(document).on("click",".user_delete",function(){
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
        var baseUrl = '{{url("")}}';
        $(document).on("click",".record_delete",function(){
          
                var id = $(this).data("id");
                Swal.fire({
                        title: 'ဖျက်ရန်သေချာပါသလား?',
                        showCancelButton: true,
                        confirmButtonText: 'အတည်ပြုမည်',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: baseUrl+'/twodrecords/'+id+'/delete',
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            cache:false,
                            processData:false,
                            contentType:false,
                            success:function(response)
                            {
                                console.log(response);
                                if(response.status == true)
                                {
                                    Swal.fire('အောင်မြင်ပါသည်', '', 'success');
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
           
        });
    </script>
@endsection