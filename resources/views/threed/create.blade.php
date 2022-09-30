@extends('layouts.moderator')
@section('title','3D')
@section('style')
	<style type="text/css">
		.threed a{
			color:#0099FF;
		}
	</style>
@endsection
@section('content')
    @include('layouts.threedheader')
	<div class="calc-body pt-3">
		<div class="calc-button-row">
			@foreach($threedlists as $key=>$threedlist)
				<!--- breaktime, number status ==1 or  login user status == 2 -->
                @php
                    $start  = $threedlist["number"];
                @endphp
				@if($threedlist["remaining"] == "breaktime" || $threedlist["status"] == 1 || Auth::user()->status == 2)
                    @if($start[0] == 0)
                        <div class="button l digit_{{$start[0]}}"><span class="stop">{{$threedlist["number"]}}</span></div>
                    @else
                        <div class="button l digit_{{$start[0]}}" style="display:none"><span class="stop">{{$threedlist["number"]}}</span></div>
                    @endif
				@else
                    @if($start[0] == 0)
					    <div class="button l digit_{{$start[0]}}"><span data-id="{{$threedlist['remaining']}}" class="number  {{$threedlist['number']}}">{{$threedlist['number']}}</span></div>
                    @else
                        <div class="button l digit_{{$start[0]}}" style="display:none"><span data-id="{{$threedlist['remaining']}}" class="number  {{$threedlist['number']}}">{{$threedlist['number']}}</span></div>
                    @endif
				@endif
			@endforeach
		</div>
	</div><!--calc-body -->
	
@endsection
@section('modals')
    <!-- ထီထိုးသည့် lists -->
	<div class="modal" id="luckyList">
	  <div class="modal-dialog modal-fullscreen">
        <form method="post" action="{{url('/2d')}}" id="luckyListFormSubmit">
            @csrf
            <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title fs-6 p-0" style="color:#E0B612">ထီထိုးမည့်စာရင်းများ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body lucky-list pt-0">

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> အတည်ပြုမည်</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> ပိတ်မည်</button>
                    </div>
            </div>
        </form>
	  </div>
	</div>
@endsection
@section('script')
<script>
    var baseUrl = '{{url("")}}';
	//alert(baseUrl);
    //alert(baseUrl);
	$(document).ready(function(){
		//ထီထိုး
		// $(document).on("submit","#luckyListFormSubmit",function(event){
		// 	event.preventDefault();
		// 	var formdata= new FormData(this);
		// 	var conf = confirm("ထီထိုးမည်မှာ သေချာပြီလား?");
		// 	if(conf == true)
		// 	{
		// 		//cleart original array to empty
		// 		selectedNumbers=[];
		// 		console.log("test"+selectedNumbers);
		// 		//remove selectedColor
		// 		$(".number").removeClass("selectedColor");
		// 		//hide modal
		// 		$("#luckyList").modal("hide");
		// 		//Rbutton clear background
		// 		$(".r").removeClass("rSelected");
		// 		//clear amount
		// 		$("#amount").val('');
		// 		//$(".loader").fadeIn();
		// 		$("#luckyListFormSubmit")[0].reset();
		// 		$.ajax({
		// 			url: baseUrl+'/2d',
		// 			type: "POST",
		// 			data:  formdata,
		// 			cache:false,
		// 			contentType:false,
		// 			processData:false,
		// 			success: function(response) {
		// 			console.log(JSON.stringify(response))
		// 			$("#luckyListFormSubmit")[0].reset();
		// 			if(response.status === true)
		// 				{
		// 					//alert("အောင်မြင်ပါသည်");
		// 					$("luckyListFormSubmit").modal("hide");
		// 					window.location.href= baseUrl+"/history/"+response.data;
		// 				}else
		// 				{
		// 					alert(response.data);
		// 				}
		// 			}
		// 		});
		// 	}
		// });
        $(document).on("change","#option100",function(){
            var myChoose = $(this).val();
            $(".l").hide();
            $(".digit_"+myChoose).show();            
        });
	});
</script>
@endsection