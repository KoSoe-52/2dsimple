
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header modal-title bg-light text-info" style="font-weight:bold">EDIT ACCOUNT</div>
                <div class="card-body">
                    @if(session('status'))
                        <p class="alert alert-success">{{session('status')}}</p>
                    @endif
                    @if(session('error'))
                        <p class="alert alert-danger">{{session('error')}}</p>
                    @endif
                    <form method="POST" >
                        @csrf
                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" style="background:#eee" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$users[0]->name}}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" style="background:#eee" class="form-control @error('password') is-invalid @enderror" name="password"   autocomplete="password" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" style="background:#eee" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $users[0]->phone }}" required autocomplete="phone" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <select name="status" id="status" style="background:#eee" class="form-control">
                                    @if($users[0]->status == 1)
                                        <option value="1" class='text-warning' selected>Active-user</option>
                                        <option value="2">Inactive-user</option>
                                    @else
                                    <option value="1" >Active-user</option>
                                        <option value="2" class='text-warning' selected>Inactive-user</option>
                                    @endif
                                </select>                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="break" class="col-md-4 col-form-label text-md-right">{{ __('Break') }}</label>
                            <div class="col-md-6">
                                <input type="text" style="background:#eee" class="form-control @error('phone') is-invalid @enderror" id="break" name="break" value="{{ $users[0]->break }}" required autocomplete="break" autofocus>
                            </div>
                        </div>
                                                   
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-paper-plane"></i>
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
