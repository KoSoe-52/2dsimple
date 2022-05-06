
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-info">{{ __('Data Update') }}</div>
                <div class="card-body">
                    @if(session('status'))
                        <p class="alert alert-success">{{session('status')}}</p>
                    @endif
                    <form method="POST" >
                        @csrf
                        
                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user[0]->name}}" required autocomplete="name" autofocus>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user[0]->phone }}" required autocomplete="phone" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user[0]->username}}" required autocomplete="username">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user[0]->password}}" required autocomplete="password">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Activation') }}</label>
                            <div class="col-md-6">
                                <select name="activation" id="activation" class="form-control">
                                    @if($user[0]->activation == 1)
                                        <option value="1" selected>Active user</option>
                                        <option value="2">Inactive user</option>
                                    @else
                                    <option value="1" >Active user</option>
                                        <option value="2" selected>Inactive user</option>
                                    @endif

                                </select>
                               
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
