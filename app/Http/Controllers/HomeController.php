<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\events;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function view_pending_appointment(){
        $pending_appointment = DB::table('appoinments')
        ->where('appointment_status','pending')
        ->get();



        return view('admin.view_pending')
        ->with('pending_appointment',$pending_appointment);
    }

    public function view_pending_appointment_id($id){
       $request_info = DB::table('appoinments')
       ->where('id',$id)
       ->first();

       if($request_info->appointment_status == "accepted")
       {
        return view('admin.view_accepted_info')
        ->with('request_info',$request_info);
       }
       elseif($request_info->appointment_status == "pending")
       {
        return view('admin.view_pending_info')
        ->with('request_info',$request_info);
       }
       elseif($request_info->appointment_status == "declined")
       {
        return view('admin.view_accepted_info')
        ->with('request_info',$request_info);
       }
       else{

       }



    }

    public function accept_request(Request $request){
            $id = $request->input('id_request');
            $date = $request->input('final_date');
            $time = $request->input('appointment_time');
        DB::table('appoinments')
        ->where('id',$id)
        ->update([
            'appointment_date'=>$date,
            'appointment_status'=>'accepted',
            'appointment_time'=>$time
        ]);
        return redirect()->action([HomeController::class, 'view_pending_appointment'])->with('alert', 'Request Accepted!');

    }
    public function decline_request(Request $request){
        $id = $request->input('id_request');
        $remarks = $request->input('final_remarks');
        $currentdate=Carbon::now()->format('Y-m-d');
    DB::table('appoinments')
    ->where('id',$id)
    ->update([

        'remarks'=>$remarks,
        'appointment_status'=>'declined',
        'appointment_date'=>$currentdate,
    ]);
    return redirect()->action([HomeController::class, 'view_pending_appointment'])->with('alert', 'Request Declined!');

}



public function appointment(){
    $data=DB::table('appoinments')
    ->where('appointment_status','pending')
    ->orWhere('appointment_status','accepted')
    ->orWhere('appointment_status','declined')
    ->get();
    return view('admin.appointment')
    ->with('data',$data);
}



public function getData(Request $request){
        // Assuming you have a column named "dropdown_value" in your database table.
        $selectedValue = $request->input('appointment');

        // Fetch data based on the selected value from the database or any other source.
        $data = DB::table('appoinments')
        ->where('appointment_status', $selectedValue)
        ->get();

        return view('admin.appointment')
    ->with('data',$data);;
}



    public function view_current_appointment(){
        $date = Carbon::now();

            $year=$date->format('Y');
            $month=$date->format('m');
            $day=$date->format('d');

       $appointment = DB::table('appoinments')
       ->whereYear('appointment_date',$year)
        ->whereMonth('appointment_date',$month)
        ->whereDay('appointment_date',$day)
       ->where('appointment_status', 'accepted')
       ->get();
       return view('admin.view_current')
       ->with('appointment',$appointment)

       ;

    }




    public function view_current_info(Request $request){
        $id = $request->input('request');
       $request_info = DB::table('appoinments')
       ->where('id',$id)
       ->first();


       if($request_info->appointment_status == "Un-attended")
       {
        return view('admin.view_current_info')
        ->with('request_info',$request_info);
       }
       else
       {
        return view('admin.view_current_info_1')
       ->with('request_info',$request_info);
       }



    }



    public function view_current_info_complete(Request $request){
        $id = $request->input('id');
        $remarks = $request->input('remarks');


        DB::table('appoinments')
        ->where('id',$id)
        ->update([

            'remarks'=>$remarks,
            'appointment_status'=>'Completed'
        ]);



        return redirect()->action([HomeController::class, 'view_current_appointment'])->with('alert', 'Request Declined!');
    }



    public function view_date_appointment(Request $request){

        $date = $request->input('slct_date');
        $test = strtotime($date);
        $slct_date = date('Y-m-d',$test);
        $appointment = DB::table('appoinments')
        ->where('appointment_date',$slct_date)
        ->get();
        return view('admin.view_appointment_date')
       ->with('appointment',$appointment);
    }





    public function history(Request $request){
        $history_date = $request->input('appointment');
        $arraycontent = explode(',', $history_date);

        $test = DB::table('appoinments')
        ->get();
        $i = 0;
        $months=array();
            foreach($test as $item)
            {

                $i++;
                $month = date('Y,m', strtotime($item->appointment_date));
                array_push($months,$month);
                // $months->put($i,$month);

            }
            $months = array_unique($months);

        $date = Carbon::now();
        $year=$date->format('Y');
        $month=$date->format('m');

        // $test=$history_date->format('Y');
        // dd($test);

            if($history_date == null)
            {
                $history = DB::table('appoinments')
                ->leftJoin('profile','appoinments.sender_id','profile.user_id')
                ->whereYear('appointment_date',$year)
                ->where('appointment_date','<',Carbon::now())
                ->orderBy('profile.year','ASC')
                ->get();
            }
            else
            {
                $history = DB::table('appoinments')
                ->leftJoin('profile','appoinments.sender_id','profile.user_id')
                ->whereYear('appointment_date',$arraycontent[0])
                ->whereMonth('appointment_date',$arraycontent[1])
                ->where('appointment_date','<',Carbon::now())
                ->orderBy('profile.year','ASC')
                ->get();
            }






        return view('admin.history')
        ->with('arraycontent',$arraycontent)
        ->with('history_date',$history_date)
        ->with('history',$history)
        ->with('months',$months);
    }


    public function month_view($id){

       $request_info = DB::table('appoinments')
       ->where('id',$id)
       ->first();


       if($request_info->appointment_status == "Un-attended")
       {
        return view('admin.view_current_info')
        ->with('request_info',$request_info);
       }
       else
       {
        return view('admin.view_current_info_1')
       ->with('request_info',$request_info);
       }
    }
    public function users()
    {
        $info = DB::table('profile')
        ->get();
        return view('admin.users')
        ->with('info',$info);
    }
    public function user_info($id)
    {
        $profile = DB::table('users')
        ->where('name',$id)
        ->first();

        $info=DB::table('profile')
        ->where('user_id',$profile->id)
        ->first();

        return view('admin.profile')
        ->with('info',$info);
    }

    public function complete(Request $request)
    {
        DB::table('appoinments')
        ->where('id',$request->input('app_id'))
        ->update([
                'appointment_status' => "Completed",
                'remarks'   => $request->input('feedback')
        ]);

        $data = DB::table('appoinments')
        ->where('id',$request->input('app_id'))
        ->first();
        Log::info('Updated appointment:', ['data' => $request->input('app_id')]);
        return response()->json(['data' => $data]);

    }


    public function events(){
        $events= events::all();
        return view('admin.events')
        ->with('events',$events);
    }

    public function eventssave(Request $request)
    {
        $data= new events();
        if($request->file('photo')){

              $file= $request->file('photo');
              $filename= date('YmdHi').$file->getClientOriginalName();
              $file-> move(public_path('public/Image'), $filename);
              $data['photo']= $filename;
              $data['title']= $request->input('title');
              $data['date']=  $request->input('date');
              $data['description']=  $request->input('description');
          }


          $data->save();



      return redirect()->back();
    }

}
