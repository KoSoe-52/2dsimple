@extends('layouts.moderator')
@section('title','Vouncher')
@section('content')
<div style="margin-bottom:70px;margin-top:6px;">
        <div class="card card-detail mb-1 pt-2">
                <div class="card-body p-0">
                    <h4 class="card-title pl-2" style="text-align:center"> {{@$vounchers[0]->name}}</h4>
                    <p class="card-text  pl-2" style="text-align:center">ပြေစာအမှတ် : <b>{{@$vounchers[0]->vouncher_id}}</b></p>
                    <p class="card-text  pl-2" style="text-align:center">ရက်စွဲ/အချိန် : {{date('d-m-Y',strtotime(@$vounchers[0]->date))}} {{@$vounchers[0]->time}}</p>
                    <table class="table table-borderless">
                        @if(count($vounchers) > 0)
                            @php $total=array(); @endphp
                            @foreach($vounchers as $key=>$vouncher)
                                <tr>
                                    <td style="border-bottom:1px solid #333">{{$key + 1}}</td>
                                    <td style="border-bottom:1px solid #333;color:#F9F9F9"><span class="rounded-circle bg-success p-2" style="color:#F9F9F9">{{$vouncher->number}}</span></td>
                                    <td style="border-bottom:1px solid #333">{{$vouncher->price}}</td>
                                </tr>
                                @php $total[]=$vouncher->price; @endphp
                            @endforeach
                            <tr>
                                <td colspan="2" style="text-align:center">စုစုပေါင်းထိုးငွေ</td>
                                <td>{{array_sum($total)}}</td>
                            </tr>
                        @else
                            <center>အချက်အလက်မရှိပါ</center>
                        @endif
                    </table>
                </div>
        </div>
</div>
@endsection
