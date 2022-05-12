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
    @endif
</div>
@endsection
