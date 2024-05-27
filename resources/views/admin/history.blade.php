@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Appointment History') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form name="submits" action="/admin/history" method="GET">
                            <select id="myDropdown" name="appointment" onChange="submits.submit()">
                                <option disabled selected="selected">--select--</option>
                                @foreach ($months as $item)
                                    <option>{{ $item }}</option>
                                @endforeach



                                <!-- Add more options as needed -->
                            </select>
                        </form>

                        <div>
                            <h3>{{ $history_date }}</h3>
                        </div>

                        <div id="forprint">
                            @if ($arraycontent[0] == '')
                                <div style="text-align:center">
                                    <h3>Appointment Reports</h3>
                                    <h4>{{ $arraycontent[0] }}</h4>
                                </div>
                            @else
                                @php

                                    $month_name = date('F', mktime(0, 0, 0, $arraycontent[1], 10));
                                @endphp

                                <div style="text-align:center">
                                    <h3>Appointment Reports</h3>
                                    <h4>{{ $arraycontent[0] }}, {{ $month_name }}</h4>
                                </div>
                            @endif


                            <div class="table-responsive-sm mt-5">
                                <table class="mt-5" id="mytable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th col hidden>ID</th>
                                            <th col>Requester</th>
                                            <th>Year level</th>
                                            <th col>Appointment Type </th>
                                            <th col>Appointment Date </th>
                                            <th col>Appointment Description </th>
                                            <th col>Appointment Remarks </th>
                                            <th col>Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($history as $items)
                                            @php
                                                $i++;
                                                $sender = DB::table('profile')
                                                    ->where('user_id', $items->sender_id)
                                                    ->first();
                                            @endphp

                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td hidden>{{ $items->id }}</td>
                                                <td>{{ $items->appointment_sender }}</td>
                                                <td>{{ $sender->year ?? '' }}</td>
                                                <td>{{ $items->appointment_type }}</td>
                                                <td>{{ $items->appointment_date }}</td>
                                                <td>{{ $items->appointment_description }}</td>
                                                <td>{{ $items->remarks }}</td>
                                                <td>
                                                    @if ($items->appointment_status == 'pending')
                                                        <button
                                                            class="btn btn-primary">{{ $items->appointment_status }}</button>
                                                    @elseif ($items->appointment_status == 'accepted')
                                                        <button
                                                            class="btn btn-warning">{{ $items->appointment_status }}</button>
                                                    @elseif ($items->appointment_status == 'Un-attended')
                                                        <button
                                                            class="btn btn-danger">{{ $items->appointment_status }}</button>
                                                    @else
                                                        <button
                                                            class="btn btn-success">{{ $items->appointment_status }}</button>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="mt-3">
                            <button onclick="PrintElem()" class="btn btn-primary "
                                id="Btn"style="margin-right:10px;float:right">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function PrintElem(forprint) {

            var printContents = document.getElementById('forprint').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            return true;
        }
    </script>
@endsection
