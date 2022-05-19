@extends('layouts.moderator')
@section('title','2D')
@section('style')
	<style type="text/css">
		.history a{
			color:#0099FF;
		}
	</style>
@endsection
@section('content')
<div style="margin-bottom:70px;margin-top:8px;">
    <form class="card-div" id="searchHistory"> 
        <table style="width:100%">
            <tr>
                <td style="width:40%;max-width:40%;">
                    <input type="date" style="padding:7px;width:100%;" name="date" value="{{request()->date}}"/>
                </td>
                <?php
                    $times = array("12:01","16:30");
                ?>
                <td style="width:30%;max-width:30%;">
                    <select style="padding:7px;width:100%;"  name="time">
                        <option value=""></option>
                        @foreach($times as $key=>$timel)
                            @if($timel == request()->time)
                                <option value="{{$timel}}" selected>{{$timel}}</option>
                            @else
                                <option value="{{$timel}}">{{$timel}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td style="width:30%;max-width:30%;">
                    <button type="submit" style="width:100%;font-size:12px;padding:10px;background-color:green;border:none;color:#f5f5f5">ရှာမည်</button>
                </td>
            </tr>
        </table>
    </form>
    <!-- <div class="loader" style="display:none;text-align:center;">
        <div class="spinner-border text-primary"></div>
    </div> -->
    @if(count($histories) > 0)
        @foreach($histories as $key=>$history)
            <div class="card mb-2 card-div">
                <a href="{{url('history/'.$history->vouncher_id)}}">
                    <div class="card-body p-0">
                        <h4 class="card-title p-0">{{$history->name}}</h4>
                        <p class="card-text  p-0" style="line-height:14px">ပြေစာအမှတ် : <b>{{$history->vouncher_id}}</b></p>
                        <p class="card-text  p-0" style="line-height:14px">ရက်စွဲ/အချိန် : {{date('d-m-Y',strtotime($history->date))}} {{$history->time}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <div class="card mb-2 card-div">
            <a href="">
                <div class="card-body p-3">
                    <p class="card-text  p-0" style="line-height:20px">အချက်အလက်မရှိသေးပါ</p>
                </div>
            </a>
        </div>
    @endif
</div>
@endsection
@section('script')
<script>
    // var baseUrl = '{{url("")}}';
	// $(document).ready(function(){
    //    $(document).on("submit","#searchHistory",function(ev){
    //     ev.preventDefault();
    //         $(".loader").fadeIn();
    //    });
    // });
</script>
@endsection
