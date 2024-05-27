<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function set_appointment(){
        return view('student_blade.set_appointment');
    }
    public function send_appointment(Request $request){
        $appointment_type = $request->input('appointment_type');
        $appointment_date = $request->input('appointment_date');
        $appointment_time = $request->input('appointment_time');
        $appointment_description = $request->input('appointment_description');
        DB::table('appoinments')
        ->insert([
            'appointment_sender'=>Auth::user()->name,
            'sender_id'=> Auth::user()->id,
            'appointment_type'=>$appointment_type,
            'appointment_date'=> $appointment_date,
            'appointment_date_send'=>Carbon::now(),
            'appointment_description'=>$appointment_description,
            'appointment_status'=>'pending'
        ]);
        // Mail::to('ajay@email.com')->send(new MyEmail());
        return redirect()->back();
    }

    public function appointment_status()
    {

        $status = DB::table('appoinments')
        ->where('sender_id', Auth::user()->id)
        ->get();
        return view('student_blade.appointment_status')
        ->with('status',$status);
    }

    public function appointment_info($id)
    {
        $info = DB::table('appoinments')
        ->where('id',$id)
        ->first();


        return view('student_blade.appointment_info')
        ->with('info',$info);
    }

    public function history()
    {
        $status = DB::table('appoinments')
        ->where('sender_id', Auth::user()->id)
        ->where('appointment_date','<',Carbon::now())

        ->get();


        return view('student_blade.history')
        ->with('status',$status);
    }
    public function profile()
    {
        $info =DB::table('profile')
        ->where('user_id',Auth::user()->id)
        ->first();
        return view('student_blade.profile')
        ->with('info',$info);
    }

    public function saveprofile(Request $request)
    {
        $info = DB::table('profile')
        ->where('user_id',Auth::user()->id)
        ->first();

        if($info == null)
        {
            DB::table('profile')
            ->insert(
                [
                    'user_id'=>Auth::user()->id,
                    'fname'=>$request->input('fname'),
                    'mname'=>$request->input('mname'),
                    'lname'=>$request->input('lname'),
                    'address'=>$request->input('address'),
                    'course'=>$request->input('course'),
                    'year'=>$request->input('year')
                ]
                );
                return redirect()->back();
        }

        else
        {
            DB::table('profile')
            ->where('user_id',Auth::user()->id)
            ->update(
                [
                    'fname'=>$request->input('fname'),
                    'mname'=>$request->input('mname'),
                    'lname'=>$request->input('lname'),
                    'address'=>$request->input('address'),
                    'course'=>$request->input('course'),
                    'year'=>$request->input('year')
                ]
                );
                return redirect()->back();
        }


    }
}
