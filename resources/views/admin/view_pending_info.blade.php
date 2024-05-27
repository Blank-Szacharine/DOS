@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pending Request Info') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <a href="/admin/view/pending-request"><button class="btn btn-primary">Back</button></a>
                    </div>

                    <div class="row mt-4">

                        <div class="col-sm-12" >
                            <div class="card-header">
                                Request Info
                            </div>
                            <div class="card-body">



                                        <div>
                                                <h3>Requester: <b>{{$request_info->appointment_sender}}</b></h3>
                                                <h3>Appointment Type: <b>{{$request_info->appointment_type}}</b></h3>
                                                <h3>Appointment Date(dd/mm/yy): <b><input name="date" id="date" type="date" value="{{$request_info->appointment_date_send}}"></b> </h3>
                                                <h3>Set Appointment Time: <b><input name="time" id="time" type="time" required></b><span style="color:red">NOTE: Set time for the appointment!</span> </h3>
                                            </div>
                                            <div class="mt-5" style="text-align:center">
                                                <h3>Description</h3>
                                                <h5>{{$request_info->appointment_description}}</h5>
                                            </div>
                                            <div class="mt-5" style="text-align:center" >
                                                    <div id="hide">
                                                            <button onclick="accept()" class="btn btn-primary" style="margin-right:5px">Accept</button>
                                                            <button onclick="cancel()" class="btn btn-danger">Decline</button>

                                                    </div>
                                                    <div id="show" hidden>
                                                        <h5>Remarks</h5>
                                                        <textarea name="remarks" id="remarks" cols="60" rows="10"></textarea>
                                                        <div class="mt-3">
                                                                <button onclick="decline()" class="btn btn-primary" style="margin-right:5px">Submit</button>
                                                                <button onclick="accept_back()" class="btn btn-danger">Cancel</button>
                                                        </div>
                                                    </div>
                                            </div>


                            </div>
                        </div>

                        </div>


                                    <form action="/save/accept/request" method="get" id="accepted">
                                        <div hidden>
                                        <input type="text" name="id_request" value="{{$request_info->id}}">
                                        <input type="date" id="final_date" name="final_date">
                                        <input type="time" id="appointment_time" name="appointment_time" required>
                                        </div>
                                    </form>

                                    <form action="/save/decline/request" method="get" id="declined">

                                    <div hidden>
                                        <input type="text" name="id_request" value="{{$request_info->id}}">
                                        <textarea name="final_remarks" id="final_remarks" cols="30" rows="10"></textarea>

                                        </div>
                                    </form>






                </div>
            </div>
        </div>
    </div>
</div>


<!-- <script>
    $(document).ready(function() {
    $('#date').change(function() {
      $('#final_date').val($(this).val());
    });
});
</script> -->


    <script>
function myFunction() {
    document.getElementById("date").disabled = false;
}
function accept(){

    document.getElementById("final_date").value=document.getElementById("date").value;
    document.getElementById("appointment_time").value=document.getElementById("time").value;
    document.getElementById("accepted").submit();
}

function cancel(){
    document.getElementById("hide").hidden = true;
    document.getElementById("show").hidden = false;
}

function accept_back(){
    document.getElementById("hide").hidden = false;
    document.getElementById("show").hidden = true;
}
function decline(){
    document.getElementById("final_remarks").value=document.getElementById("remarks").value;
    document.getElementById("declined").submit();
}
</script>















@endsection
