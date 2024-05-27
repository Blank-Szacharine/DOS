@extends('layouts.appuser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
               <div class="row" style="text-align:center">
                    <div class="col-sm-4"><a href="/user/set-appointment"><Button class="" style="width:90%;border:none;background:#fb8500;border-radius: 5px;"  >Set Appointment</Button></a></div>
                    <div class="col-sm-4"><a href="/user/appointment-status"><Button style="width:90%;border:none;background:#fb8500;border-radius: 5px;" >Appointment Status</Button></a></div>
                    <div class="col-sm-4"><a href="/user/history"><Button  style="width:90%;border:none;background:#FFD300;border-radius: 5px;">Appointment History</Button></a></div>
               </div>

               
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Appointments</div>
                            <div class="card-body">
                                <div class="container mt-2">

                                <div class="container">
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Appointment Type</th>
                                                <th>Appointment Date</th>
                                                <th>Appointment Description</th>
                                                <th>Appointment Remark</th>
                                                <th>Appointment Status</th>
                                                <th>Action</th>
                                                <!-- Add more columns as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($status as $items)
                                            <tr>
                                                <td>{{$items->appointment_type}}</td>
                                                <td>{{$items->appointment_date}}</td>
                                                <td>{{$items->appointment_description}}</td>
                                                <td>{{$items->remarks}}</td>
                                                <td>{{$items->appointment_status}}</td>
                                                <td><a href="{{url('/user/appointment/info',$items->id)}}"><button class="btn btn-primary">View</button></a></td>
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
            </div>
                    

<!--  -->
                </div>
            </div>
        </div>
    </div>
</div>



<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>


<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        // DataTables options and configurations
    });
});
</script>






@endsection
