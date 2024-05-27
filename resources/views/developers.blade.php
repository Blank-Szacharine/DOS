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
            <b>Dean's Online Appointment System</b>

            
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
                <b>Online Appointment for 
                   <br> Dean's</b>
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


        <div class="container mt-5">
            <h3>Developers</h3>
                <div class="row">
                    <div class="col-sm-4" style="text-align:center">
                        <img src="{{ asset('images/') }}" alt="" style="width:60%;border-radius:50%">
                        <h3>Jimbell</h3>
                        <h3>09******</h3>
                        
                    </div>
                    <div class="col-sm-4" style="text-align:center">
                        <img src="{{ asset('images/') }}" alt="" style="width:60%;border-radius:50%">
                        <h3>Jimbell</h3>
                        <h3>09******</h3>
                    </div>
                    <div class="col-sm-4" style="text-align:center">
                        <img src="{{ asset('images/') }}" alt="" style="width:60%;border-radius:50%">
                        <h3>Jimbell</h3>
                        <h3>09******</h3>
                    </div>
                </div>
            </div>

        
        
        
        
      

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
