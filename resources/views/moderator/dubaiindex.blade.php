@extends('layouts.moderator')
@section('title','Dubai 2D')
@section('style')
	<style type="text/css">
		.dubai2d a{
			color:#0099FF;
		}
	</style>
@endsection
@section('content')
    @include('layouts.dubaiheader')
	<div class="calc-body pt-3">
		<div class="calc-button-row">
			@foreach($twodlists as $key=>$twodlist)
				<!--- breaktime, number status ==1 or  login user status == 2 -->
				@if($twodlist["remaining"] == "breaktime" || $twodlist["status"] == 1 || Auth::user()->status == 2)
					<div class="button l"><span class="stop">{{$twodlist["number"]}}</span></div>
				@else
					<div class="button l"><span data-id="{{$twodlist['remaining']}}" class="number  {{$twodlist['number']}}">{{$twodlist['number']}}</span></div>
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
	<!-- အမြန်ရွေး -->
	<div class="modal" id="fast-choose-modal">
	  <div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
		  <!-- Modal body -->
		  <div class="modal-body">
			<h5>ရိုးရိုး</h5>
			<button type="button" id="sameDigit" class="btn btn-outline-primary group1">အပူး</button>
			<button type="button" id="soneSone" class="btn btn-outline-primary group1">စုံစုံ</button>
			<button type="button" id="soneMa" class="btn btn-outline-primary group1">စုံမ</button>
			<button type="button" id="maMa"   class="btn btn-outline-primary group1">မမ</button>
			<button type="button" id="maSone" class="btn btn-outline-primary group1">မစုံ</button>
			<h5 class="mt-2">ပါတ်</h5>
			<button type="button" id="pad" class="btn btn-outline-primary group3">0</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">1</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">2</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">3</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">4</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">5</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">6</button>
			<button type="button" id="pad" class="btn btn-outline-primary group3">7</button>
			<button type="button" id="pad" class="btn btn-outline-primary mt-1 group3">8</button>
			<button type="button" id="pad" class="btn btn-outline-primary mt-1 group3">9</button>
			<h5 class="mt-2">ထိပ်</h5>
			<button type="button" id="front" class="btn btn-outline-primary group2">0</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">1</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">2</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">3</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">4</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">5</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">6</button>
			<button type="button" id="front" class="btn btn-outline-primary group2">7</button>
			<button type="button" id="front" class="btn btn-outline-primary mt-1 group2">8</button>
			<button type="button" id="front" class="btn btn-outline-primary mt-1 group2">9</button>
			<h5 class="mt-2">နောက်</h5>
			<button type="button" id="back"  class="btn btn-outline-primary group2">0</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">1</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">2</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">3</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">4</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">5</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">6</button>
			<button type="button" id="back"  class="btn btn-outline-primary group2">7</button>
			<button type="button" id="back"  class="btn btn-outline-primary mt-1 group2">8</button>
			<button type="button" id="back"  class="btn btn-outline-primary mt-1 group2">9</button>
			<h5 class="mt-2">ဘရိတ်</h5>
			<button type="button" id="break"  class="btn btn-outline-primary group4">0</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">1</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">2</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">3</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">4</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">5</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">6</button>
			<button type="button" id="break"  class="btn btn-outline-primary group4">7</button>
			<button type="button" id="break"  class="btn btn-outline-primary mt-1 group4">8</button>
			<button type="button" id="break"  class="btn btn-outline-primary mt-1 group4">9</button>
			<h5 class="mt-2">နက္ခတ်၊ ပါဝါ</h5>
			<button type="button" id="nagkhatDigit" class="btn btn-outline-primary group1">နက္ခတ်</button>
			<button type="button" id="powerDigit"   class="btn btn-outline-primary group1">ပါဝါ</button>
			<button type="button" id="nyikoDigit"   class="btn btn-outline-primary group1">ညီအကို</button>
			<h5 class="mt-2">ခွေ</h5>
			<input type="number"  id="khawe" class="w-50 p-1"  autocomplete="off" style="border:1px solid #0099FF">
			<button type="button"  class="btn btn-outline-primary float-right khawe-btn">ခွေမည်</button>
			<br/>
			<button type="button" class="btn btn-danger float-end mt-2" data-bs-dismiss="modal">ပိတ်မည်</button>
		  </div>
		</div>
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
		$(document).on("submit","#luckyListFormSubmit",function(event){
			event.preventDefault();
			var formdata= new FormData(this);
			var conf = confirm("ထီထိုးမည်မှာ သေချာပြီလား?");
			if(conf == true)
			{
				//cleart original array to empty
				selectedNumbers=[];
				console.log("test"+selectedNumbers);
				//remove selectedColor
				$(".number").removeClass("selectedColor");
				//hide modal
				$("#luckyList").modal("hide");
				//Rbutton clear background
				$(".r").removeClass("rSelected");
				//clear amount
				$("#amount").val('');
				//$(".loader").fadeIn();
				$("#luckyListFormSubmit")[0].reset();
				$.ajax({
					url: baseUrl+'/dubai2d',
					type: "POST",
					data:  formdata,
					cache:false,
					contentType:false,
					processData:false,
					success: function(response) {
					console.log(JSON.stringify(response))
					$("#luckyListFormSubmit")[0].reset();
					if(response.status === true)
						{
							//alert("အောင်မြင်ပါသည်");
							$("luckyListFormSubmit").modal("hide");
							window.location.href= baseUrl+"/dubaihistory/"+response.data;
						}else
						{
							alert(response.data);
						}
					}
				});
			}
		});
	});
</script>
@endsection