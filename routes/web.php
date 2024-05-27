<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $currentDate = now();
    $events = DB::table('events')
        ->whereDate('date', '>', $currentDate)
        ->orwhereDate('date', $currentDate)
        ->get();
    return view('welcome')
        ->with('events', $events);
});

Route::get('/developers', function () {
    return view('developers');
});

Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        $date = Carbon::now();
        $year = $date->format('Y');
        $month = $date->format('m');
        $day = $date->format('d');
        $currentDate = now();
        if (Auth::user()->role == "admin") {

            $test = DB::table('appoinments')
                ->where(function ($query) {
                    $query->where('appointment_status', 'pending')
                        ->orWhere('appointment_status', 'accepted');
                })
                ->whereDate('appointment_date', '<', $currentDate)
                ->get('id');



            foreach ($test as $row) {

                DB::table('appoinments')
                    ->where('id', $row->id)
                    ->where(function ($query) {
                        $query->where('appointment_status', 'pending')
                            ->orWhere('appointment_status', 'accepted');
                    })
                    ->update([
                        'appointment_status' => 'Un-attended'
                    ]);
            }

            $appointment = DB::table('appoinments')
                ->where('appointment_status', 'pending')
                ->paginate(2);

            $currentdate = Carbon::now()->format('Y-m-d');

            $appointmentnow = DB::table('appoinments')
                ->where('appointment_status', 'accepted')
                ->where('appointment_date', $currentdate)
                ->paginate(2);

            $count_today = DB::table('appoinments')
                ->where('appointment_status', 'accepted')
                ->where('appointment_date', $currentdate)
                ->count();

            $count_unfinish = DB::table('appoinments')
                ->where('appointment_status', 'accepted')
                ->count();

            $date = Carbon::now();

            $year = $date->format('Y');
            $month = $date->format('m');
            $day = $date->format('d');

            $monthly_appointment = DB::table('appoinments')
                ->whereYear('appointment_date', $year)
                ->whereMonth('appointment_date', $month)
                ->where('appointment_status', 'accepted')
                ->orderBy('appointment_date')
                ->get();

            $all = DB::table('appoinments')
                ->select(DB::raw('count(*) as user_count', ''))
                ->whereYear('appointment_date', $year)
                ->whereMonth('appointment_date', $month)
                ->get();






            $count_pending = count($appointment);


            return view('home', compact('count_pending', 'appointment', 'appointmentnow', 'count_today', 'count_unfinish', 'monthly_appointment', 'all', 'year', 'month'));
        } elseif (Auth::user()->role == "user") {
            $currentDate = now();

            $test = DB::table('appoinments')
                ->where(function ($query) {
                    $query->where('appointment_status', 'pending')
                        ->orWhere('appointment_status', 'accepted');
                })
                ->whereDate('appointment_date', '<', $currentDate)
                ->get('id');



            foreach ($test as $row) {

                DB::table('appoinments')
                    ->where('id', $row->id)
                    ->where(function ($query) {
                        $query->where('appointment_status', 'pending')
                            ->orWhere('appointment_status', 'accepted');
                    })
                    ->update([
                        'appointment_status' => 'Un-attended'
                    ]);
            }

            $appointment = DB::table('appoinments')
                ->where('appointment_status', 'pending')
                ->paginate(2);

            $currentdate = Carbon::now()->format('Y-m-d');

            $appointmentnow = DB::table('appoinments')
                ->where('appointment_status', 'accepted')
                ->where('appointment_date', $currentdate)
                ->paginate(2);

            $count_today = DB::table('appoinments')
                ->where('appointment_status', 'accepted')
                ->where('appointment_date', $currentdate)
                ->count();

            $count_unfinish = DB::table('appoinments')
                ->where('appointment_status', 'accepted')
                ->count();

            $date = Carbon::now();

            $year = $date->format('Y');
            $month = $date->format('m');
            $day = $date->format('d');

            $monthly_appointment = DB::table('appoinments')
                ->whereYear('appointment_date', $year)
                ->whereMonth('appointment_date', $month)
                ->where('appointment_status', 'accepted')
                ->orderBy('appointment_date')
                ->get();

            $all = DB::table('appoinments')
                ->select(DB::raw('count(*) as user_count', ''))
                ->whereYear('appointment_date', $year)
                ->whereMonth('appointment_date', $month)
                ->get();






            $count_pending = count($appointment);
            $events = DB::table('events')
                ->whereDate('date', '>', $currentDate)
                ->orwhereDate('date', $currentDate)
                ->get();
            return view('student_blade.home',compact('count_pending', 'appointment', 'appointmentnow', 'count_today', 'count_unfinish', 'monthly_appointment', 'all', 'year', 'month','events'));

        } else {

        }


    });

});

Route::middleware(['auth', 'UserRoleMiddleware'])->group(function () {

    Route::get('/user/set-appointment', [App\Http\Controllers\UserController::class, 'set_appointment'])->name('set_appointment');
    Route::post('/send/appointment', [App\Http\Controllers\UserController::class, 'send_appointment'])->name('send_appointment');
    Route::get('/user/appointment-status', [App\Http\Controllers\UserController::class, 'appointment_status'])->name('appointment_status');
    Route::get('/user/appointment/info/{is}', [App\Http\Controllers\UserController::class, 'appointment_info'])->name('appointment_status');
    Route::get('/user/history', [App\Http\Controllers\UserController::class, 'history'])->name('set_appointment');
    Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('set_appointment');
    Route::get('/profile/save', [App\Http\Controllers\UserController::class, 'saveprofile'])->name('set_appointment');

});

Route::middleware(['auth', 'AdminRoleMiddleware'])->group(function () {

    Route::get('/admin/appointment', [App\Http\Controllers\HomeController::class, 'appointment'])->name('appointment');
    Route::get('/admin/view/pending-request', [App\Http\Controllers\HomeController::class, 'view_pending_appointment'])->name('view_pending_appointment');
    Route::get('/admin/view/pending-request/view/{is}', [App\Http\Controllers\HomeController::class, 'view_pending_appointment_id'])->name('view_pending_appointment_id');
    Route::get('/admin/view/appointment/{is}', [App\Http\Controllers\HomeController::class, 'view_pending_appointment_id'])->name('view_pending_appointment_id');
    Route::get('/save/accept/request', [App\Http\Controllers\HomeController::class, 'accept_request'])->name('accept_request');
    Route::get('/save/decline/request', [App\Http\Controllers\HomeController::class, 'decline_request'])->name('decline_request');
    Route::get('/get-data', [App\Http\Controllers\HomeController::class, 'getData'])->name('get.data');
    Route::get('/admin/view/current-appointment', [App\Http\Controllers\HomeController::class, 'view_current_appointment'])->name('view_pending_appointment');
    Route::get('/admin/view/current-appointment/view', [App\Http\Controllers\HomeController::class, 'view_current_info'])->name('view_pending_appointment');
    Route::get('/admin/view/current-appointment/view/complete', [App\Http\Controllers\HomeController::class, 'view_current_info_complete'])->name('view_pending_appointment');
    Route::get('/admin/home/date/view/appointment', [App\Http\Controllers\HomeController::class, 'view_date_appointment'])->name('view_pending_appointment');
    Route::get('/admin/history', [App\Http\Controllers\HomeController::class, 'history'])->name('history');
    Route::get('/admin/view/{is}', [App\Http\Controllers\HomeController::class, 'month_view'])->name('history');
    Route::get('/admin/events', [App\Http\Controllers\HomeController::class, 'events'])->name('history');
    Route::get('/admin/users', [App\Http\Controllers\HomeController::class, 'users'])->name('history');
    Route::get('/admin/user/view/{is}', [App\Http\Controllers\HomeController::class, 'user_info'])->name('appointment_status');
    Route::get('/admin/user/view/{is}', [App\Http\Controllers\HomeController::class, 'user_info'])->name('appointment_status');
    Route::get('/complete', [App\Http\Controllers\HomeController::class, 'complete']);
    Route::post('/eventsadd', [App\Http\Controllers\HomeController::class, 'eventssave']);


});
