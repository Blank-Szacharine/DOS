@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  

<!--  -->

                        <div style="text-align:center">
                            <h1>Account INFO</h1>
                        </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                                <input type="text" name="fname" value="{{$info->fname}}" class="form-control" placeholder="First Name" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                                <input type="text" name="mname" value="{{$info->mname}}" class="form-control" placeholder="Middle Name" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                                <input type="text" name="lname" value="{{$info->lname}}" class="form-control" placeholder="Last Name" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                                <input type="text" name="address" value="{{$info->address}}" class="form-control" placeholder="Address" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                                <input type="text" name="course" value="{{$info->course}}" class="form-control" placeholder="Course" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                                <input type="text" name="year" value="{{$info->year}}" class="form-control" placeholder="Year" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                    



<!--  -->
                </div>
            </div>
        </div>
    </div>
</div>










@endsection
