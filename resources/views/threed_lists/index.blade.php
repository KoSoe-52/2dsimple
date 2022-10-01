@extends('layouts.master')
@section('title','ThreeD စာရင်းပေါင်းချုပ်')
@section('header')
    <div class="col-5 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-normal mb-3">စာရင်းပေါင်းချုပ်</h4>
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
        <div class="container-fluid">
            <form class="row">
                <div class="form-group col-xs-6 col-sm-6 col-md-3 col-xl-3">
                    <label for="sorting">စီမည်</label>
                    <?php $sorting = array("sortingnumber"=>"ဂဏန်းငယ်စဉ်ကြီးလိုက်","sortingamount"=>"ထိုးငွေကြီးစဉ်ငယ်လိုက်"); ?>
                    <select name="sorting" id="sorting" class="form-control">
                        @foreach($sorting as $key=>$data)
                            @if($key == request()->sorting)
                                <option value="{{$key}}" selected>{{$data}}</option>
                            @else
                                <option value="{{$key}}">{{$data}}</option>
                            @endif
                        @endforeach
                                            </select>
                </div>
                <div class="form-group col-xs-6 col-sm-6 col-md-3 col-xl-3">
                    <button type="submit" id="search" class="btn btn-primary mt-3">ရှာမည်</button>
                </div>
                
            </form>
        </div>

        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th>ဂဏန်း</th>
                        <th>ရက်စွဲ</th>
                        <!-- <th>အချိန်</th> -->
                        <th>ပမာဏ</th>
                        <th>ပိတ်/မပိတ်</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total=array(); @endphp
                    @foreach($numberTotal as $number=>$amount)
                        <tr>
                            <td><span class="rounded-circle bg-success p-1" style="font-size:22px;font-weight:bold;color:red;">{{$number}}</span></td>
                            <td>{{$date}}</td>
                            <td><span style="font-size:25px;font-weight:bold;color:red;">{{$amount}}</span></td>
                            <td data-id="{{$date}}">
                                @if(in_array($number,$terminatedNumbers))
                                    <input type="checkbox" checked class="openOption" data-id="{{$number}}" id="open_{{$number}}"> <label for="open_{{$number}}" class="text-danger font-weight-bold">ဖွင့်ရန်</label>
                                @else
                                    <input type="checkbox" class="closeOption" data-id="{{$number}}" id="close_{{$number}}"> <label for="close_{{$number}}">ပိတ်ရန်</label>
                                @endif
                            </td>
                        </tr>
                        @php $total[]=$amount; @endphp
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align:right">စုစုပေါင်း</td>
                        <td style="font-weight:bold">{{array_sum($total)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section("script")
    <script>
        $(document).ready(function(){
            var baseUrl = '{{url("")}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(document).on("click",".closeOption",function(){
            if($(this).is(":checked"))
            {
                var id = $(this).data("id");
                var date = $(this).parent().data("id");
                var formdata = new FormData();
                formdata.append("date",date);
                Swal.fire({
                        title: 'ရွေးထားသည့်ဂဏန်းများ ပိတ်မှာလား?',
                        showCancelButton: true,
                        confirmButtonText: 'အတည်ပြုမည်',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        //Swal.fire('Saved!', '', 'success')
                        $.ajax({
                            url: baseUrl+'/3d/'+id+'/terminate',
                            type: "POST",
                            data: formdata,
                            cache:false,
                            processData:false,
                            contentType:false,
                            success:function(response)
                            {
                                //console.log(response.data);
                                if(response.status == true)
                                {
                                    Swal.fire('အောင်မြင်ပါသည်', '', 'success');
                                    window.location.reload();
                                }
                            }
                        });
                    }else
                    {
                        $(".closeOption").each(function(){
                            $(this).prop("checked",false);
                        });
                    }
                });
            }else
            {
                $(".closeOption").each(function(){
                    $(this).prop("checked",false);
                });
            }
        });
        $(document).on("click",".openOption",function(){
            if($(this).is(":checked"))
            {
                //$(this).prop("checked",true);
            }else
            {
                var id = $(this).data("id");
                var date = $(this).parent().data("id");
                var formdata = new FormData();
                formdata.append("date",date);
                Swal.fire({
                        title: 'ရွေးထားသည့်ဂဏန်း ပြန်ဖွင့်မည်?',
                        showCancelButton: true,
                        confirmButtonText: 'အတည်ပြုမည်',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        //Swal.fire('Saved!', '', 'success')
                        $.ajax({
                            url: baseUrl+'/3d/'+id+'/open',
                            type: "POST",
                            data: formdata,
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
                                }else
                                {
                                    Swal.fire('မအောင်မြင်ပါသည်', '', 'error');
                                    $(this).prop("checked",true);
                                }
                            }
                        });
                    }else
                    {
                        $(this).prop("checked",true);
                    }
                });
            }
        });
    });
        
    </script>
@endsection
