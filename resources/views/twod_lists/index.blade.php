@extends('layouts.master')
@section('title','ကိုယ်စားလှယ်များ')
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
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th>ဂဏန်း</th>
                        <th>ရက်စွဲ</th>
                        <th>အချိန်</th>
                        <th>ပမာဏ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total=array(); @endphp
                    @foreach($numberTotal as $number=>$amount)
                        <tr>
                            <td><span class="rounded-circle bg-success p-2">{{$number}}</span></td>
                            <td>{{date('d-m-Y')}}</td>
                            <td>{{$twodTime}}</td>
                            <td><span style="font-size:25px;font-weight:bold;color:red;">{{$amount}}</span></td>
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
