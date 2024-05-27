@extends('layouts.app')
<style>
    #btn{
        color:#0d6efd; 
        border-color:#0d6efd;
    }
#btn:hover{
            background-color:#0d6efd;
            color:white;
}
.calendar {
    width: 100%;
    height:100%;
    margin: 0 auto;
    box-shadow: 0 0 5px #ccc;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    color:#dc3545;
}

.days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background-color: #f9f9f9;
    padding: 10px;
}

.day {
    color:#dc3545;
    position: relative;
    padding: 5px;
    border: 1px solid #FF9800;
    cursor: pointer;
    text-align:center;
}

.day span{

    


    color:white;
    font-size:12px;
    text-align:center;
    width:16px;
    height:16px;
    border-radius:50%;
    position: absolute;
    top: 0;
    right: 0;   
    background-color: #5bc0de;
}

.counts{
    background-color: #e0e0e0;
}

.day:hover {
    background-color: #e0e0e0;
}

.selected-date {
    margin-top: 20px;
    font-weight: bold;
}

#novalue{
    display:none;
}


</style>
@section('content')


@php
$end = 33;

$i = 1;
$count_day=array($i);
            for($i = 1; $i<$end; $i++)
            {
                
                array_push($count_day,$i);
                $appointmentperdaycount=array("");


                
            }

            unset($count_day[0]);

            foreach($count_day as $days)
                {
                    $appointmentperday = DB::table('appoinments')
                    ->whereYear('appointment_date',$year)
                    ->whereMonth('appointment_date',$month)
                    ->whereDay('appointment_date', $days)
                    ->where('appointment_status','accepted')
                    ->count('appointment_date');

                    array_push($appointmentperdaycount,$appointmentperday);
                }

                

            

@endphp


<script>






document.addEventListener('DOMContentLoaded', function () {
    var allcount = {!! json_encode($appointmentperdaycount) !!};




    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');
    const monthYear = document.getElementById('monthYear');
    const daysContainer = document.querySelector('.days');



    
    const selectedDate = document.getElementById('selectedDate');
    const submits =  document.getElementById('testss');

    let currentDate = new Date();

    function renderCalendar() {
        const currentMonth = currentDate.getMonth();
        const currentYear = currentDate.getFullYear();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

        monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${currentYear}`;

        daysContainer.innerHTML = '';
        

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('day', 'empty');
            daysContainer.appendChild(emptyDay);
        }

        
        
        for (let i = 1; i <= daysInMonth; i++) {
            const day = document.createElement('div');
            const counts = document.createElement('span');
            if (allcount[i] == 0) {
                counts.setAttribute("id","novalue");
            }
            else{  
                counts.textContent =allcount[i];
            }

            
            
            day.textContent = i;
            day.classList.add('day');
            day.addEventListener('click', function () {
                const clickedDate = new Date(currentYear, currentMonth, i);
                selectedDate.value = clickedDate.toDateString();
                document.getElementById("testss").submit();
            });
            day.appendChild(counts);
            daysContainer.appendChild(day);
            
        }
    }

    
    prevBtn.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextBtn.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
});

    </script>

    
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

                    
                <div class="container">
                    <div class="row" style="text-align:center;paddinf:5px;">
                        <div class="col-md-4" ><div style="background:#FF9800;border-radius:5px;color:#dc3545; height:100%"><h3 style="padding:5px">Request Appointment <p style="color:#F6412D">{{$count_pending}}</p> </h3></div></div>
                        <div class="col-md-4" ><div style="background:#FF9800;border-radius:5px;color:#dc3545; height:100%"><h3 style="padding:5px">Today's Appointment <p style="color:#F6412D">{{$count_today}}</p> </h3></div></div>
                        <div class="col-md-4" ><div style="background:#FF9800;border-radius:5px;color:#dc3545;"><h3 style="padding:5px">Unfinish Appointment <p style="color:#F6412D">{{$count_unfinish}}</p> </h3></div></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div style="background:#fff;width:100%;height:30vh;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                                <div style="text-align:center;padding:5px">
                                    <h3 style="color:#F6412D"><b>Pending Request</b></h3>
                                    @foreach($appointment as $item)
                                    <p>{{$item->appointment_sender}} - {{$item->appointment_type}}</p>
                                    @endforeach
                                    <a href="/admin/view/pending-request"  ><button id="btn" class="btn" style="">View more</button></a>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background:#fff;width:100%;height:30vh;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                                <div style="text-align:center;padding:5px">
                                    <h3 style="color:#F6412D"><b>Today's Schedule</b></h3>
                                    @foreach($appointmentnow as $item)
                                    <p>{{$item->appointment_sender}} - {{$item->appointment_type}}</p>
                                    @endforeach
                                    <a href="/admin/view/current-appointment"><button id="btn" class=" btn  ">View more</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div style="background:#fff;width:100%;height:100%;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                            <div style="text-align:center;padding:5px">
                                <h3 style="color:#F6412D"><b>This month's Schedule</b></h3>
                                @foreach($monthly_appointment as $item)
                                <a href="{{url('/admin/view',$item->id)}}"><p>{{$item->appointment_sender}} - {{$item->appointment_type}} - {{$item->appointment_date}}</p></a>

                                    @endforeach
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div style="background:#fff;width:100%;height:100%;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                            <div class="calendar" style=";width:100%;height:100%;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                                <div class="header">
                                    <button id="prevMonth" style="background:#FF9800; border:none; border-radius:5px;">&lt;</button>
                                    <h2 id="monthYear"></h2>
                                    <button id="nextMonth" style="background:#FF9800; border:none; border-radius:5px;">&gt;</button>
                                </div>
                                <div class="days"></div>
                            </div>
                        </div>

    
    <div class="selected-date">
        
    </div>

                        </div>
                    </div>
                </div>



                </div>
            </div>
        </div>
    </div>
</div>
<form action="/admin/home/date/view/appointment" id="testss" method="get">
<input type="text" id="selectedDate" name="slct_date" hidden>
</form>

<script>
    function myFunctiondate(){
        document.getElementById("pass").submit();
    }
</script>











<script>
    (function(){
  $('#msbo').on('click', function(){
    $('body').toggleClass('msb-x');
  });
}());
</script>



<script>
  const elementsWithZeroText = document.querySelectorAll('.days span');

  elementsWithZeroText.forEach(element => {
    if (element.textContent.trim() === '0') {
      element.classList.add('hidden');
    }
  });
</script>



<!-- 


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
-->
@endsection 
