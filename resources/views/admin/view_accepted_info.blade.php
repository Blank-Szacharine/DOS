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
                                                <h3>Requester: <b>{{$request_info->appointment_sender}}</b>
                                                <a href="{{url('/admin/user/view',$request_info->appointment_sender)}}"><button class="btn btn-primary" style="margin-right:5px">View</button></a>
                                                </h3>
                                                <h3>Appointment Type: <b>{{$request_info->appointment_type}}</b></h3>
                                                <h3>Appointment Date(dd/mm/yy): <b><input disabled name="date" id="date" type="date" value="{{$request_info->appointment_date_send}}"></b> </h3>

                                            </div>
                                            <div class="mt-5" style="text-align:center">
                                                <h3>Description</h3>
                                                <textarea name="remarks" id="remarks" cols="60" rows="10" disabled>{{$request_info->appointment_description}}</textarea>


                                            </div>
                                            <div class="mt-5" style="text-align:center" >
                                                    <div id="hide">


                                                    </div>
                                                    <div id="show">
                                                        <h5>Feedback</h5>
                                                        <textarea name="remarks" id="remarks" cols="60" rows="10" disabled>{{$request_info->remarks}}</textarea>

                                                    </div>
                                            </div>


                            </div>
                        </div>

                        </div>









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

















@endsection
