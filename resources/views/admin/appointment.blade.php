@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Appointment') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                       <form name="submits" action="/get-data" method="GET">
                            <select id="myDropdown" name="appointment" onChange="submits.submit()">
                                    <option disabled selected="selected">--select--</option>
                                    <option value="pending">Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="declined">Declined</option>
                                    <!-- Add more options as needed -->
                                </select>
                       </form>

                       <div class="table-responsive-sm mt-5">
                    <table class="mt-5" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th col hidden>ID</th>
                                        <th col>Requester</th>
                                        <th col>Appointment Type </th>
                                        <th col>Appointment Date </th>
                                        <th col>Status</th>
                                        <th col>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i =0;
                                @endphp
                                @foreach($data as $items)
                                 @php
                                    $i ++;
                                @endphp

                                    <tr>
                                                <td>{{$i}}</td>
                                                <td hidden>{{$items->id}}</td>
                                                <td>{{$items->appointment_sender}}</td>
                                                <td>{{$items->appointment_type}}</td>
                                                <td>{{$items->appointment_date}}</td>
                                                <td>{{$items->appointment_status}}</td>
                                                <td><a href="{{url('/admin/view/appointment',$items->id)}}"><button class="btn btn-primary">Views</button></a></td>

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
