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

        $appointment['host_id'] = $request->input('host_id');
        $appointment['guest_id'] = $request->input('guest_id');
        $appointment['guest_name'] = $request->input('guest_name');
        $appointment['guest_designation'] = $request->input('guest_designation');
        $appointment['note'] = $request->input('note');
        $appointment['location'] = $request->input('location');
        $appointment['assistant_id'] = $user->id;
        $appointment['avatar'] = $request->input('avatar');
        $appointment['appointment_status_id'] = 4;

//        dd($appointment);

        $appointment->save();

        return response()->json(['success' => 'success'], app('Illuminate\Http\Response')->status());


    }

    public function create(Request $request)
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

        $appointment['host_id'] = $request->input('host_id');
        $appointment['guest_id'] = $user->id;
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

    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
