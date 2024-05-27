<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DOA'S</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Styles -->

    </head>
    <body class="antialiased" >

        <div>

        </div>



        <div id="navbar" >
            <b>CICS Online Appointment System</b>


        </div>

        <div class="dropdown">


            <a href="{{ url('/') }}"><button class="btn">Home</button></a>
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                More
            </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/developers">Developers</a></li>
                <li><a class="dropdown-item" href="/contact">Contact</a></li>
                </ul>

        </div>


        <div class="row" id="img-div">

            <div class="col-sm-6">
                <div id="text">
                <b>CICS Online Appointment System
                </div >
                <div id="href" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10" >
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="col-sm-6"></div>
        </div>


        <div class="container">
        <div class="row mt-5" style="height:400px">
            <div class="col-sm-8">
                <div style="text-align:right">
                <h1>CICS Dean</h1>
                <h2>Dr. Julieta B. Babas</h2>

                </div>
                <p><h3 style="text-align:center"><i>It’s not computers that creates wonderful innovations, it’s the hands and minds of IT professionals .</i></h3></p>
            </div>

            <div class="col-sm-4">
                <img src="images/pic1.jpg" alt="" style="width:100%">
            </div>

        </div>





        <div class="row mt-5">
            <div class="col-sm-8">
                <div id="event-break"><b>Events</b></div>
@foreach($events as $event)

                    <div class=" row mt-2" id="events">

                        <div class="col-sm-4" style='background-repeat: no-repeat, repeat;background-size: cover;height:200px;background-position: center; background-image: url("{{ url('public/Image/'.$event->photo) }}");'></div>
                    <div class="col-sm-8">
                        <span id="text-img"><h4>Title - {{$event->title}}</h4></span>
                        <span id="text-img"><h5>Date - {{$event->date}}</h5></span>
                        <span id="text-img">Description <br>
                             {{$event->description}}
                        </span>
                    </div>
                </div>
                <hr>
@endforeach

            </div>
            <div class="col-sm-4">
                <div id="event-break"><b>Calendar</b></div>
                <div class="wrapper">
                    <header>
                        <p class="current-date"></p>
                            <div class="icons">
                            <span id="prev" class="material-symbols-rounded"><</span>
                            <span id="next" class="material-symbols-rounded">></span>
                            </div>
                    </header>
                    <div class="calendar">
                        <ul class="weeks">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                        </ul>
                        <ul class="days"></ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="row mt-5 mb-5">
            <div class="col-sm-4">
                <h3>Mission</h3>
                Cagayan State University shall produce globally competent graduates through excellent instruction, innovative and creative research, responsive public service and productive industry and community engagement.
            </div>
            <div class="col-sm-4">
            <h3>Vision</h3>
            CSU is a University with global stature in the arts, culture, agriculture and fisheries, the sciences as well as technological and professional fields.
            </div>
            <div class="col-sm-4">
            <h3>Core Values</h3>
            <b>Competence</b> <br>
            -Critical Thinker<br>
            -Creative Problem -Solver<br>
            -Competitive Performer: Nationally, Regionally and Globally.<br>
            <b>Social Responsibility</b><br>
            Sensitive to Ethical Demands<br>
            Steward of the Environment for Future Generations<br>
            Social Justice and Economic Equity Advocate.<br>
            <b>Unifying Presence</b><br>
            Uniting Theory and Practice<br>
            Uniting Strata of Society<br>
            Unifying the Nation, the ASEAN Region and the world<br>
            Uniting the University and the community.<br>
            </div>
        </div>
        <!--  -->
        </div>







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
<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2024 Copyright:
    <a class="text-dark" href="/">DOA'S.com</a>
  </div>
  <!-- Copyright -->
</footer>
    </body>
</html>
