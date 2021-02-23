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
                            <div class="col-md-5"><h2>PDA</h2></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                            <form method="post" action="{{ route('pdapurcase') }}">                        
                                <div class="form-group">
                                @csrf
                                    <label for="address">{{ __('lang.PDA Mac address') }}: </label>
                                    <input type="text" id="wifimac" name="wifimac" placeholder="placeholder" required />
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('lang.PDA Name') }}: </label>
                                    <input type="text" id="pdaname" name="pdaname" placeholder="placeholder" required />
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('lang.PDA Description') }}: </label>
                                    <input type="text" id="description" name="description" placeholder="description" required />
                                </div>
                                <div class="form-group">
                                    <label for="purchaseddate">{{ __('lang.PDA Purchased Date') }}: </label>
                                    <input type="text" id="purchaseddate" name="purchaseddate" placeholder="2021-02-29" required />
                                </div>
                                <div class="form-group">
                                    <label for="reference">{{ __('lang.PDA Reference') }}: </label>
                                    <input type="text" id="reference" name="reference" placeholder="warehouse" required />
                                </div>
                                <div class="form-group">
                                    <label for="batterylevel">{{ __('lang.PDA Battery Level') }}: </label>
                                    <input type="number" id="batterylevel" name="batterylevel" placeholder="100" min="0" max="100" required />
                                </div>
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