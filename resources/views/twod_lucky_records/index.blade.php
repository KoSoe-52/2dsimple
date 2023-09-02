@extends('layouts.master')
@section('title','ကိုယ်စားလှယ်များ')
@section('header')
    <div class="col-5 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-normal mb-3">ထိုးထားသည့်စာရင်းများ</h4>
    </div>
    <div class="col-1 align-self-center">
        
    </div>
    <!-- <div class="col-6 align-self-center">
        <div class="customize-input float-right" style="margin-right:5px;">
            <button  class=" form-control bg-success border-0 custom-shadow custom-radius text-white">
               <a href="{{url(Auth::user()->roles->name.'/alluserExport')}}" class='text-white'>Excel-Export <i class="fa fa-file-excel text-white"></i></a>
            </button>
        </div>
    </div> -->
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
                    <label for="time">အချိန်</label>
                    <select name="time" id="time" class="form-control">
                        <option value=""></option>
                        <option value="12:01">12:01</option>
                        <option value="16:30">16:30</option>
                    </select>
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
        <div class="col-12 mb-3">
			<button type="button" class="btn btn-sm btn-danger del-modal-btn mb-3"  style="float:right;display:none;"><i class="fa fa-times"></i> Delete</button>
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
						<th><input type="checkbox" id="all"> <label for="all" style="cursor:pointer">All</label> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = array(); ?>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$record->number}}</td>
                            <td>{{date('d-m-Y',strtotime($record->date))}}</td>
                            <td>{{$record->time}}</td>
                            <td>{{$record->price}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->users->name}}</td>
                           <td>
								<input class="m-0  del-checkbox" type="checkbox" id="id{{$record->id}}" data-id="{{ $record->id }}"> 
                                <label for="id{{$record->id}}" style="cursor:pointer">Check  </label>
							</td>
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
            $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
            // $(document).on("click",".user_delete",function(){
            //     var id = $(this).data("id");
            //     var conf = confirm("Are  you sure want to delete?");
            //     if(conf ==  true)
            //     {
            //         $.ajax({
            //             url: baseUrl+'/delete/'+id,
            //            // url: {{url("Auth::user()->roles->name.")}}'/users/delete/'+id,
            //             type: "GET",
            //             data: {
            //                 "_token": "{{ csrf_token() }}",
            //               },
            //             cache:false,
            //             processData:false,
            //             contentType:false,
            //             success:function(response)
            //             {
            //                 if(response.status == true)
            //                 {
            //                     alert(response.msg);
            //                     window.location.href=baseUrl;
            //                 }
            //             }
            //         });
            //     }
            // });
            $(document).on("click",".del-modal-btn",function(ev){
				ev.preventDefault();
                Swal.fire({
                    title: 'ဖျက်ရန်သေချာပါသလား? အားလုံး Check ထားလျှင် အကုန်ပျက်ပါမည်...',
                    showCancelButton: true,
                    confirmButtonText: 'အတည်ပြုမည်',
                }).then((result) => {
                    if(result.isConfirmed) {
                        var idArray = [];
                        var formdata = new FormData();
                        $(".del-checkbox").each(function(){
                            if(this.checked)
                            {
                                idArray.push($(this).data("id"));
                            }
                        });
                       // console.log(idArray);
                        //formdata.append("idArray",idArray);
                        formdata.append("numberArray",idArray);

                        $.ajax({
                            url:"{{ route('deleteMultiplethi') }}",
                            type: "POST",
                            data: formdata,
                            cache:false,
                            contentType:false,
                            processData:false,
                            success: function(response) {
                                console.log(JSON.stringify(response))
                                if(response.status === true)
                                {
                                    Swal.fire({
                                        title: response.msg,
                                        icon:'success',
                                        width: 300,
                                        color: '#716add',
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                    setInterval(() => {
                                        window.location.reload();
                                    }, 1500);
                                }else
                                {
                                    Swal.fire({
                                        title: response.msg,
                                        icon:'warning',
                                        width: 300,
                                        color: '#716add',
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                    });
                                }
                            },error: function (request, status, error) {
                                Swal.fire({
                                        title: error,
                                        icon:'error',
                                        width: 300,
                                        color: '#716add',
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    });
                            }
                        });
                    }
                });
				
			});
            $(document).on("click","#all",function(){
				if($(this).is(":checked"))
				{
					$(".del-checkbox").prop("checked",true);
					$(".del-checkbox").next().text('Checked');
					$(".del-modal-btn").fadeIn();
				}else
				{
					$('.del-checkbox').prop('checked',false);
					$(".del-checkbox").next().text('Check');
					$(".del-modal-btn").fadeOut();
				}
			});
			$(document).on("click",".del-checkbox",function(){
				if($(this).is(":checked"))
				{
					$(this).prop("checked",true);
					$(this).next().text('Checked');
					$(".del-modal-btn").fadeIn();
				}else
				{
					$(this).prop('checked',false);
					$(this).next().text('Check');
					var somethingChecked = 0;
					$(".del-checkbox").each(function(){
						if(this.checked)
						{
							somethingChecked = 1;
							console.log("checked");
						}
					});
					if(somethingChecked == 1) {
						$(".del-modal-btn").fadeIn();
					}else
					{
						$(".del-modal-btn").fadeOut();
					}
				}
			});
        });
        var baseUrl = '{{url("")}}';
        // $(document).on("click",".record_delete",function(){
          
        //         var id = $(this).data("id");
        //         Swal.fire({
        //                 title: 'ဖျက်ရန်သေချာပါသလား?',
        //                 showCancelButton: true,
        //                 confirmButtonText: 'အတည်ပြုမည်',
        //             }).then((result) => {
        //             if (result.isConfirmed) {
        //                 $.ajax({
        //                     url: baseUrl+'/twodrecords/'+id+'/delete',
        //                     type: "GET",
        //                     data: {
        //                         "_token": "{{ csrf_token() }}",
        //                     },
        //                     cache:false,
        //                     processData:false,
        //                     contentType:false,
        //                     success:function(response)
        //                     {
        //                         console.log(response);
        //                         if(response.status == true)
        //                         {
        //                             Swal.fire('အောင်မြင်ပါသည်', '', 'success');
        //                             window.location.reload();
        //                         }
        //                     }
        //                 });
        //             }
        //         });
           
        // });
    </script>
@endsection