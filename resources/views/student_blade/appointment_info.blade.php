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
                                    <div class="col-sm-4"><a href="/user/appointment-status"><Button  style="width:90%;border:none;background:#FFD300;border-radius: 5px;">Appointment Status</Button></a></div>
                                    <div class="col-sm-4"><a href="/user/history"><Button style="width:90%;border:none;background:#fb8500;border-radius: 5px;">Appointment History</Button></a></div>
                            </div>

                            <div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Appointment Info') }}</div>


                <div class="row mt-3 p-3">
                    <div class="col-sm-6">
                            <h3>Appointment Type: <b>{{$info->appointment_type}}</b></h3>
                            <h3>Appointment Date Schedule: <b>{{$info->appointment_date}}</b></h3>
                            <h3>Appointment Time Schedule: <b><input type="time" value="{{$info->appointment_time}}" disabled></b></h3>

                            <h3>Appointment Status: <b>{{$info->appointment_status}}</b></h3>

                            <br><br><br><br>
                            <h3>Please Show this number this to the Dean to know your Transaction</h3>
                            <h1>{{$info->id}}</h1>


                    </div>
                    <div class="col-sm-6">
                    <div>
                            <h3>Appointment Description:</h3>
                            <textarea name="" id="" rows="10" style="width:100%">
{{$info->appointment_description}}
                            </textarea>
                            </div>
                            <div>
                            <h3>Appointment Remarks:</h3>
                            <textarea name="" id="" rows="10" style="width:100%">
{{$info->remarks}}
                            </textarea>
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
        </div>
    </div>
</div>













<script>
    (function(){
  $('#msbo').on('click', function(){
    $('body').toggleClass('msb-x');
  });
}());
</script>








<script>
    const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = i === date.getDate() && currMonth === new Date().getMonth()
                     && currYear === new Date().getFullYear() ? "present" : "";
        liTag += `<li class="${isToday}">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
}
renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});
</script>
@endsection
