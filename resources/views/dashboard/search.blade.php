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
                    <div class="container-fluid">
                        <div id="searchbar" class="row">
                            <div class="col-lg-5 col-md-4"><h2>{{ __('lang.Search') }}</h2></div>
                            <div class="col-lg-3 col-md-3">
                                <div class='input-group date' id='init-date'>
                                    <input type='text' class="form-control" id="init" value="2021/02/06 18:00" placeholder="Enter initial date here" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class='input-group date' id='end-date'>
                                    <input type='text' class="form-control" id="end" value="2021/02/03 18:00" placeholder="Enter end date here" />
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-1">
                                <input type="button" id="search" value="{{ __('lang.Search') }}" class="input-group btn btn-primary" />
                            </div>
                        </div>
                        <table id="batterytable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('lang.WiFi MAC Address') }}</th>
                                    <th>{{ __('lang.Battery Level') }}</th>
                                    <th>{{ __('lang.Date / Time') }}</th>
                                    <th>{{ __('lang.User') }}</th>
                                    <th>{{ __('lang.PDA Name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batteries as $battery)
                                <tr>
                                    <td>{{$battery->wifi_mac}}</td>
                                    <td>@if( $battery->charge_status == "charging")
                                    <img src="/assets/images/battery-32.png" width="25" />
                                    @else
                                    <img src="/assets/images/battery-50.png" width="25" />
                                    @endif
                                    {{$battery->battery_level}}%</td>
                                    <td>{{$battery->updated_at}}</td>
                                    <td>{{$battery->user_id}}</td>
                                    <td>{{$battery->pdaname}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.2/jquery.datetimepicker.min.css" integrity="sha512-3dtBPuxXKnFHg58fXxfBmHJMG6QnTDUKCbCgdArYYZlpw1Q+QPTraVoZjwaKV13Kgqv1Ptf7gBIEmqC7b/vzUg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script type='text/javascript'>
        $(document).ready(function($){
            $("#init").datetimepicker();
            $("#end").datetimepicker();
            $("#search").click(function(){
                var sdate = $("#init").val();
                var edate = $("#end").val();
                var i = 0;
                for(i = 0; i < $("#batterytable tbody tr").length; i++){
                    $("#batterytable tbody tr:nth-child("+(i+1)+")").show();
                    if(Date.parse($("#batterytable tbody tr:nth-child("+(i+1)+") td:nth-child("+3+")").html()) >= Date.parse(sdate) && Date.parse($("#batterytable tbody tr:nth-child("+(i+1)+") td:nth-child("+3+")").html()) <= Date.parse(edate)){
                        $("#batterytable tbody tr:nth-child("+(i+1)+")").show();
                    }else{
                        $("#batterytable tbody tr:nth-child("+(i+1)+")").hide();
                    }
                }
            });
            $('#batterytable').DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                processing: true,
                info: false,
                columnDefs: [
                    { orderable: false, targets: 1 },
                    { orderable: false, targets: 2 },
                    { orderable: false, targets: 3 },
                    { orderable: false, targets: 4 }
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>