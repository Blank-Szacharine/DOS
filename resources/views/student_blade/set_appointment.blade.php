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
                    <div class="col-sm-4"><a href="/user/set-appointment"><Button class="" style="width:90%;border:none;background:#FFD300;border-radius: 5px;">Set Appointment</Button></a></div>
                    <div class="col-sm-4"><a href="/user/appointment-status"><Button style="width:90%;border:none;background:#fb8500;border-radius: 5px;">Appointment Status</Button></a></div>
                    <div class="col-sm-4"><a href="/user/history"><Button style="width:90%;border:none;background:#fb8500;border-radius: 5px;">Appointment History</Button></a></div>
               </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Set Appointment</div>
                            <div class="card-body">
                                <div class="container mt-2">

                                        <form action="/send/appointment" method="POST">
                                            @csrf
                                                <div style="text-align:center">
                                                                    <label for="subjectclass"><h3>Appointment Type </h3></label> <br>
                                                                    <!-- <select class="select"  id="subjectclass"name="subjectclass" size=1 onChange="submitsubject.submit()"> -->
                                                                    <select class="select"  id="appointment_type"name="appointment_type">
                                                                    <option value="" style="text-align:center" disabled="disabled" selected="selected">--select--</option>
                                                                    <option value="Enrollment">Enrollment</option>
                                                                    <option value="Clearance">Clearance</option>
                                                                    <option value="Completion">Completion of Grades</option>
                                                                    <option value="Consultation">Consultation</option>
                                                                    <option value="Others">Others:</option>
                                                                    </select>

                                                </div>

                                            <div class="mt-2" style="text-align:center">
                                                <label for="startDate"><h3>Date </h3></label> <br>
                                                <input style="width:200px"  name="appointment_date"  type="date" id="txtDate"/>
                                            </div>


                                            <div class="mt-3">
                                                <label for="comment">Description</label>
                                                <textarea name="appointment_description" id="comment" style="width:100%" rows="10"></textarea>
                                            </div>

                                            <div style="text-align:center">
                                                <button type="submit" type="button" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!--  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;


    $('#txtDate').attr('min', maxDate);
});
</script>



                </div>
            </div>
        </div>
    </div>
</div>










@endsection
