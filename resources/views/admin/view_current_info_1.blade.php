@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Appointment's Info</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <a href="/admin/view/current-appointment/"><button class="btn btn-primary">Back</button></a>
                        </div>
                        <div class="alert alert-success" role="alert" id="ajaxAlert" style="display: none;">
                            Completed
                          </div>


                        <form action="/complete" method="get" id="complete">
                            <div style="font-family:tahoma;">

                                <div style="text-align:center">
                                    <h3><b>Appointment Info</b></h3>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-sm-6">
                                        <div>

                                            <input type="text" value="{{ $request_info->id }}" name="app_id" hidden>
                                            <h5>Requester: {{ $request_info->appointment_sender }}</h5>
                                            <h5>Type of Appointment: {{ $request_info->appointment_type }}</h5>
                                            <h5>Date of Appointment: {{ $request_info->appointment_date }}</h5>
                                            <h5>Time of Appointment: <input type="time" name="" disabled value="{{ $request_info->appointment_time }}"></h5>
                                            <br><br><br>
                                            <h2 style="text-align:center">The Transaction Id is</h2>
                                            <h1 style="text-align:center">{{ $request_info->id }}</h1>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <h5>Description:</h5>
                                            <textarea name="" id="" cols="60" rows="10" disabled>{{ $request_info->appointment_description }}</textarea>
                                        </div>
                                        <div>
                                            <h5>Feedback :</h5>

                                            <textarea name="feedback" id="" cols="60" rows="10"></textarea>
                                        </div>


                                    </div>
                                </div>


                                <div class="text-center mt-3">
                                    <button class="btn btn-primary">Complete</button>
                                </div>

                            </div>
                        </form>






                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#complete').on('submit', function(event) {
                event.preventDefault();

                jQuery.ajax({
                    url: "{{ url('complete') }}",
                    data: jQuery('#complete').serialize(),
                    type: 'get',


                    success: function(result) {
                        $("#ajaxAlert").fadeIn().delay(2000).fadeOut();
                        document.getElementById("ajaxAlert").scrollIntoView({ behavior: 'smooth' });
                    }

                })

            });

        });
    </script>
@endsection
