@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Today's Appointmen Info</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <a href="/admin/view/current-appointment/"><button class="btn btn-primary">Back</button></a>
                    </div>


                    <form action="/admin/view/current-appointment/view/complete" method="get">
                        <div style="font-family:tahoma;">

                            <div style="text-align:center">
                                <h3 ><b>Appointment Info</b></h3>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div>
                                        <input type="text" value="{{$request_info->id}}" name="id" hidden>
                                    <h5>Requester: {{$request_info->appointment_sender}}</h5>
                                    <h5>Type of Appointment: {{$request_info->appointment_type}}</h5>
                                    <h5>Date of Appointment: {{$request_info->appointment_date}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <h5>Description:</h5>
                                        <textarea name="" id="" cols="60" rows="10" disabled>{{$request_info->appointment_description}}</textarea>
                                    </div>

                                    <div>
                                        <h5>Remarks:</h5>
                                        <textarea name="remarks" id="" cols="60" rows="10" disabled>{{$request_info->remarks}}</textarea>

                                    </div>
                                </div>
                            </div>




                            </div>
                    </form>






                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>

$(document).ready(function(){

// code to read selected table row cell data (values).
$("#mytable").on('click','#view',function(){
     // get the current row
     var currentRow=$(this).closest("tr");
     var row=currentRow.find("td:eq(1)").text(); // get current row 1st TD value
     var id=currentRow.find("td:eq(1)").text(); // get current row 1st TD value
     var name=currentRow.find("td:eq(3)").text(); // get current row 2nd TD
     var appointment=currentRow.find("td:eq(4)").text(); // get current row 3rd TD
     var date=currentRow.find("td:eq(5)").text(); // get current row 3rd TD
     document.getElementById('request').value = id;
     document.getElementById("pass").submit();

});
});
</script>

















@endsection
