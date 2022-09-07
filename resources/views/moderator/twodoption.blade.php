@extends('layouts.moderator')
@section('title','2D Option')
@section('style')
	<style type="text/css">
		.histories a{
			color:#0099FF;
		}
	</style>
@endsection
@section('content')
<div style="margin-bottom:70px;margin-top:8px;">
    <div class="card mb-2 card-div">
        <a href="{{url('history')}}">
            <div class="card-body p-0">
                <h4 class="card-title p-0">Thailand 2D</h4>
                <p class="card-text  p-0" style="line-height:14px">History </p>
            </div>
        </a>
    </div>
    <div class="card mb-2 card-div">
        <a href="{{url('dubaihistory')}}">
            <div class="card-body p-0">
                <h4 class="card-title p-0">Dubai 2D</h4>
                <p class="card-text  p-0" style="line-height:14px">History </p>
            </div>
        </a>
    </div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection
