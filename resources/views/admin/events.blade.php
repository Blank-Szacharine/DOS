@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Events') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div style="text-align:right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Add</button>
                        </div>

                        <div class="table-responsive-sm mt-5">
                            <table class="mt-5" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th col hidden>ID</th>
                                        <th col>Title</th>
                                        <th col>Date</th>
                                        <th col>Description</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp

                                    @php
                                        $i++;
                                    @endphp
@foreach($events as $event)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td hidden></td>
                                        <td>{{$event->title}}</td>
                                        <td>{{$event->date}}</td>
                                        <td>{{$event->description}}</td>

                                    </tr>
@endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--  --}}
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Event</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <form id="addevent" action="/eventsadd" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">TITLE</label>
                                                <input type="text" class="form-control" id="" name="title"
                                                    aria-describedby="emailHelp" placeholder="Enter event title">
                                                <small id="emailHelp" class="form-text text-muted">Title of the
                                                    event</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Date</label>
                                                <input type="date" class="form-control" id="" name="date"
                                                    aria-describedby="emailHelp" placeholder="Enter event title">
                                                <small id="emailHelp" class="form-text text-muted">Date of the
                                                    event</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <input type="text" class="form-control" id="" name="description"
                                                    aria-describedby="emailHelp" placeholder="Enter event description">
                                                <small id="emailHelp" class="form-text text-muted">Description of the
                                                    event</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <input type="file" class="form-control" id="" name="photo"
                                                    aria-describedby="emailHelp" placeholder="Enter event description">
                                                <small id="emailHelp" class="form-text text-muted">Image of the
                                                    event</small>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" onclick="submit()" class="btn btn-primary">Add Event</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{--  --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <script type="text/javascript">

    function submit()
    {
        document.getElementById('addevent').submit();
    }
        $(document).ready(function () {


        $("#addevent").submit(function (e) {
            e.preventDefault();
            alert("y");
            $.ajax({
                type: "POST",
                url: "add_user.php",
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User added successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function () {
                        location.reload();
                    });
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to add user. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
    </script>
@endsection
