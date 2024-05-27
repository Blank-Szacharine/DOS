@extends('layouts.appuser')
<style>
    #btn {
        color: #0d6efd;
        border-color: #0d6efd;
    }

    #btn:hover {
        background-color: #0d6efd;
        color: white;
    }

    .calendar {
        width: 100%;
        height: 100%;
        margin: 0 auto;
        box-shadow: 0 0 5px #ccc;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        color: #dc3545;
    }

    .days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background-color: #f9f9f9;
        padding: 10px;
    }

    .day {
        color: #dc3545;
        position: relative;
        padding: 5px;
        border: 1px solid #FF9800;
        cursor: pointer;
        text-align: center;
    }

    .day span {




        color: white;
        font-size: 12px;
        text-align: center;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        position: absolute;
        top: 0;
        right: 0;
        background-color: #5bc0de;
    }

    .counts {
        background-color: #e0e0e0;
    }

    .day:hover {
        background-color: #e0e0e0;
    }

    .selected-date {
        margin-top: 20px;
        font-weight: bold;
    }

    #novalue {
        display: none;
    }
</style>
@php
    $end = 33;

    $i = 1;
    $count_day = [$i];
    for ($i = 1; $i < $end; $i++) {
        array_push($count_day, $i);
        $appointmentperdaycount = [''];
    }

    unset($count_day[0]);

    foreach ($count_day as $days) {
        $appointmentperday = DB::table('appoinments')
            ->whereYear('appointment_date', $year)
            ->whereMonth('appointment_date', $month)
            ->whereDay('appointment_date', $days)
            ->where('appointment_status', 'accepted')
            ->count('appointment_date');

        array_push($appointmentperdaycount, $appointmentperday);
    }

@endphp


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var allcount = {!! json_encode($appointmentperdaycount) !!};




        const prevBtn = document.getElementById('prevMonth');
        const nextBtn = document.getElementById('nextMonth');
        const monthYear = document.getElementById('monthYear');
        const daysContainer = document.querySelector('.days');




        const selectedDate = document.getElementById('selectedDate');
        const submits = document.getElementById('testss');

        let currentDate = new Date();

        function renderCalendar() {
            const currentMonth = currentDate.getMonth();
            const currentYear = currentDate.getFullYear();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

            monthYear.textContent =
                `${currentDate.toLocaleString('default', { month: 'long' })} ${currentYear}`;

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
                    counts.setAttribute("id", "novalue");
                } else {
                    counts.textContent = allcount[i];
                }



                day.textContent = i;
                day.classList.add('day');
                day.addEventListener('click', function() {
                    const clickedDate = new Date(currentYear, currentMonth, i);
                    selectedDate.value = clickedDate.toDateString();
                    document.getElementById("testss").submit();
                });
                day.appendChild(counts);
                daysContainer.appendChild(day);

            }
        }


        prevBtn.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextBtn.addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    });
</script>
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
                            <div class="col-sm-4"><a href="/user/set-appointment"><Button
                                        style="width:90%;border:none;background:#fb8500;border-radius: 5px;">Set
                                        Appointment</Button></a></div>
                            <div class="col-sm-4"><a href="/user/appointment-status"><Button
                                        style="width:90%;border:none;background:#fb8500;border-radius: 5px;">Appointment
                                        Status</Button></a></div>
                            <div class="col-sm-4"><a href="/user/history"><Button
                                        style="width:90%;border:none;background:#fb8500;border-radius: 5px;">Appointment
                                        History</Button></a></div>
                        </div>

                        <div class="mt-5">
                            <h2>Dean Availability</h2>
                            <div
                                style="background:#fff;width:100%;height:100%;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                                <div class="calendar"
                                    style=";width:100%;height:100%;border-radius:10px;box-shadow: 5px 10px #aaaaaa;">
                                    <div class="header">
                                        <button id="prevMonth"
                                            style="background:#FF9800; border:none; border-radius:5px;">&lt;</button>
                                        <h2 id="monthYear"></h2>
                                        <button id="nextMonth"
                                            style="background:#FF9800; border:none; border-radius:5px;">&gt;</button>
                                    </div>
                                    <div class="days"></div>
                                </div>
                            </div>
                            <div class="selected-date">

                            </div>
                        </div>

                        <div class="mt-5">
                            <h1>Events</h1>
                            @foreach ($events as $event)
                                <div class=" row mt-2" id="events">

                                    <div class="col-sm-4"
                                        style='background-repeat: no-repeat, repeat;background-size: cover;height:200px;background-position: center; background-image: url("{{ url('public/Image/' . $event->photo) }}");'>
                                    </div>
                                    <div class="col-sm-8">
                                        <span id="text-img">
                                            <h4>Title - {{ $event->title }}</h4>
                                        </span>
                                        <span id="text-img">
                                            <h5>Date - {{ $event->date }}</h5>
                                        </span>
                                        <span id="text-img">Description <br>
                                            {{ $event->description }}
                                        </span>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>













    <script>
        (function() {
            $('#msbo').on('click', function() {
                $('body').toggleClass('msb-x');
            });
        }());
    </script>
@endsection
