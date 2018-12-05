<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Appointment;
use App\User;
use Carbon\Carbon;

class AppoinmentsController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        //
    }

    public function createWalking(Request $request)
    {
//        return response()->json(['success' => "success"], $this->successStatus);

//        $input = $request->all();
//        dd($input);

        $validator = Validator::make($request->all(), [

            'host_id' => 'required',

            'guest_name' => 'required',

            'location' => 'required',
        ]);


        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }

        $user = Auth::user();
        $appointment = new Appointment();

        $appointment['host_id'] = $request->input('host_id'); //To whom the request going
        $appointment['guest_id'] = $request->input('guest_id'); //if the user has an app account
        $appointment['guest_name'] = $request->input('guest_name'); //name of who is asking for walking appointment
        $appointment['guest_designation'] = $request->input('guest_designation');
        $appointment['note'] = $request->input('note');
        $appointment['location'] = $request->input('location');
        $appointment['assistant_id'] = $user->id;
        $appointment['avatar'] = $request->input('avatar');
        $appointment['appointment_status_id'] = 4; // 4 is walking request status

//        dd($appointment);

        $appointment->save();

        return response()->json(['success' => 'success'], app('Illuminate\Http\Response')->status());


    }

    public function createRequst(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'host_id' => 'required',

            'location' => 'required',

            'time' => 'required',

            'date' => 'required',
        ]);


        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }

        $user = Auth::user();
        $appointment = new Appointment();

        $appointment['host_id'] = $request->input('host_id'); //who is getting the request
        $appointment['guest_id'] = $user->id; //who is asking for request
        $appointment['note'] = $request->input('note');
        $appointment['location'] = $request->input('location');
        $appointment['time'] = Carbon::parse($request->input('time'));
        $appointment['date'] = Carbon::parse($request->input('date'));

//        dd($appointment);
//        dd($appointment['date']->toFormattedDateString());
//        dd($appointment['time']->format('g:i A'));

        $appointment->save();

        return response()->json(['success' => 'success'], app('Illuminate\Http\Response')->status());

    }


    public function createMyGuest(Request $request)
    {
        $user = Auth::user();
        $appointment = new Appointment();

        $appointment['host_id'] = $user->id; //who is setting the appointment
        $appointment['guest_name'] = $request->input('guest_name');
        $appointment['assistant_id'] = $request->input('assistant_id');
        $appointment['note'] = $request->input('note');
        $appointment['time'] = Carbon::parse($request->input('time'));
        $appointment['date'] = Carbon::parse($request->input('date'));
        $appointment['appointment_status_id'] = 1; // for my guest the appointment is already accepted


//        dd($appointment);
//        dd($appointment['date']->toFormattedDateString());
//        dd($appointment['time']->format('g:i A'));

        $appointment->save();

        return response()->json(['success' => 'success'], app('Illuminate\Http\Response')->status());

    }
}
