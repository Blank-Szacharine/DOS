@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('This Date Appointment') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <a href="/home"><button class="btn btn-primary">Back</button></a>
                    </div>

                    <div class="row mt-4">

                        <div class="col-sm-12" >
                            <div class="card-header">
                            @foreach($appointment as $items)
                            <h2><b>{{$items->appointment_date}}</b></h2>
                            @endforeach
                            </div>
                            <div class="card-body">

                                <div class="table-responsive-sm mt-5">
                    <table class="mt-5" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th col hidden>ID</th>
                                        <th col>Requester</th>
                                        <th col>Appointment Type </th>
                                        <th col>Appointment Date </th>
                                        <th col>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i =0;
                                @endphp
                                @foreach($appointment as $items)
                                 @php
                                    $i ++;
                                @endphp

                                    <tr>
                                                <td>{{$i}}</td>
                                                <td hidden>{{$items->id}}</td>
                                                <td>{{$items->appointment_sender}}</td>
                                                <td>{{$items->appointment_type}}</td>
                                                <td>{{$items->appointment_date}}</td>
                                                <td><button id="view" class="btn btn-primary">View</button></td>

                                    </tr>

                                   @endforeach
                                </tbody>
                                </table>
                    </div>


                            </div>
                        </div>

                        </div>


                        <form action="/admin/view/current-appointment/view" id="pass" method="get">
                            <input type="text" name="request" id="request" hidden>

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
