@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    <div class="col-md-12">
                        <h2>{{ __('lang.Users') }} {{ __('lang.Edit') }}</h2>
                    </div>
                    <div class="container-fluid row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <form method="post" action="{{ route('users.update', $user->id ) }}">                        
                            <div class="form-group">
                            @csrf
                            @method('PATCH')
                                <label for="firstname">{{ __('lang.First Name') }}: </label>
                                <input type="text" id="firstname" name="firstname" placeholder="firstname" value="{{ $user->firstname }}" required />
                            </div>
                            <div class="form-group">
                                <label for="lastname">{{ __('lang.Last Name') }}: </label>
                                <input type="text" id="lastname" name="lastname" placeholder="lastname" value="{{ $user->lastname }}" required />
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('lang.User Name') }}: </label>
                                <input type="text" id="name" name="name" placeholder="name" value="{{ $user->name }}" required />
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('lang.Password') }}: </label>
                                <input type="password" id="password" name="password" placeholder="password" value="{{ $user->password }}" required />
                            </div>
                            <div class="form-group">
                                <label for="confpass">{{ __('lang.Confirm Pass') }}: </label>
                                <input type="password" id="confpass" name="confpass" placeholder="confpass" value="{{ $user->confpass }}" required />
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('lang.User Email') }}: </label>
                                <input type="email" id="email" name="email" placeholder="email" value="{{ $user->email }}" required />
                            </div>
                            <div class="form-group">
                                <label for="useremail"></label>
                                <button type="submit" class="btn btn-primary">{{ __('lang.Update User') }}</button>
                                <button type="reset" class="btn btn-warning">{{ __('lang.Reset') }}</button>
                                <a href="/users" class="btn btn-danger">{{ __('lang.Cancel') }}</a>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection