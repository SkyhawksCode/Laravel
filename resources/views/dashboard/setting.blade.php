@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                        {{ session()->get('success') }}  
                        </div><br />
                    @endif
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5"><h2>{{ __('lang.Setting') }}</h2></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                            <form method="post" action="{{ route('settingsave') }}">                        
                                <div class="form-group">
                                @csrf
                                    <label for="interval">{{ __('lang.Interval') }}(min): </label>
                                    <input type="number" id="interval" name="interval" placeholder="{{ __('lang.Interval') }}" value="{{ ($settings)?($settings->interval):0 }}" min="0" max="60" required />
                                </div>
                                <div class="form-group">
                                    <label for="lowbattery">{{ __('lang.Low Level Email Battery') }}(%): </label>
                                    <input type="number" id="lowbattery" name="lowbattery" placeholder="{{ __('lang.Low Level Email Battery') }}" value="{{ ($settings)?($settings->lowbattery):0 }}" min="0" max="100" required />
                                </div>
                                <div class="form-group">
                                    <label for="adminemail">{{ __('lang.Admin Email') }}: </label>
                                    <input type="email" id="adminemail" name="adminemail" placeholder="info@ewamfy.com" value="{{ ($settings)?($settings->adminemail):'' }}" required />
                                </div><input type="number" id="id" name="id" value="{{ ($settings)?($settings->id):0 }}" hidden />
                                <div class="form-group">
                                    <label for="interval"></label>
                                    <button type="submit" class="btn btn-primary">{{ __('lang.Save') }}</button>
                                    <button type="reset" class="btn btn-warning">{{ __('lang.Reset') }}</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.2/jquery.datetimepicker.min.css" integrity="sha512-3dtBPuxXKnFHg58fXxfBmHJMG6QnTDUKCbCgdArYYZlpw1Q+QPTraVoZjwaKV13Kgqv1Ptf7gBIEmqC7b/vzUg==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
<script type='text/javascript'>
    $(document).ready(function($){
        
    });
</script>