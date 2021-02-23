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
                            <div class="col-md-5"><h2>{{ __('lang.Dashboard') }}</h2></div>                            
                        </div>
                        <table id="batterytable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('lang.Current User') }}</th>
                                    <th>{{ __('lang.PDA Name') }}</th>
                                    <th>{{ __('lang.Battery Level') }}</th>
                                    <th>{{ __('lang.Time Used') }}</th>
                                    <th>{{ __('lang.Date / Time') }}</th>
                                    <th>{{ __('lang.Last User') }}</th>
                                    <th>{{ __('lang.WiFi MAC Address') }}</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.2.2/jquery.datetimepicker.min.css" integrity="sha512-3dtBPuxXKnFHg58fXxfBmHJMG6QnTDUKCbCgdArYYZlpw1Q+QPTraVoZjwaKV13Kgqv1Ptf7gBIEmqC7b/vzUg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
<script>
function ajax(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = {};
    var type = "POST";
    var ajaxurl = 'home/ajax';
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: function (data) {
            var html = "";
            for(var k in data) {                
                html += "<tr>";
                html += "<td>"+data[k].user_id+"</td>";
                html += "<td>"+data[k].pdaname+"</td>"; 
                if(data[k].charge_status == "Charging"){               
                     html += "<td><img src='/assets/images/battery-32.png' width='25' />"+data[k].battery_level+"%</td>"; 
                }else{
                     html += "<td><img src='/assets/images/battery-50.png' width='25' />"+data[k].battery_level+"%</td>";   
                }               
                html += "<td>"+data[k].usedtime+"</td>";             
                html += "<td>"+data[k].updated_at+"</td>";             
                html += "<td>"+data[k].last_user_id+"</td>";                
                html += "<td>"+data[k].wifi_mac+"</td>";                
                html += "</tr>";                
            }
            $("#tbody").html(html);
        },
        error: function (data) {
            console.log(data);
        }
    }); 
}
$(document).ready(function () {
    $('#batterytable').DataTable({
        lengthChange: false,
        searching: false,
        paging: false,
        processing: true,
        info: false,
        columnDefs: [
            { orderable: false, targets: 0 },
            { orderable: false, targets: 6 }
        ]
    });
    ajax();
    $('.dataTables_length').addClass('bs-select');
    var myVar = setInterval(ajax, 1000);   
});
</script>