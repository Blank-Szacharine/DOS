@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




                       <div id="forprint">

                       <div style="text-align:center">
                            <h3>Users Profile</h3>
                       </div>

                       <div class="table-responsive-sm mt-5">
                    <table class="mt-5" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th col>NAME</th>
                                        <th col>Address</th>
                                        <th col>Course</th>
                                        <th col>Year</th>


                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i =0;
                                @endphp
                                @foreach($info as $items)
                                 @php
                                    $i ++;


                                @endphp



                                    <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$items->fname}} {{$items->mname}} {{$items->lname}}</td>
                                                <td>{{$items->address}}</td>
                                                <td>{{$items->course}}</td>
                                                <td>{{$items->year}}</td>

                                    </tr>

                                   @endforeach
                                </tbody>
                                </table>
                    </div>


                    </div>
                    <div class="mt-3">
                    <button onclick="PrintElem()" class="btn btn-primary " id="Btn"style="margin-right:10px;float:right" >Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function PrintElem(forprint)
{

            var printContents = document.getElementById('forprint').innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
    return true;
}

</script>





@endsection
