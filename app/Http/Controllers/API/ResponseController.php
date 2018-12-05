<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showAllPendingRequests()
    {
        $user = Auth::user();
        $appointments = Appointment::where('host_id', $user->id)->get();

//        dd($appointments);

        $results = array();
        foreach ($appointments as $appointment) {
            if (empty($appointment->guest_id)) {
//                dd($appointment->name);
                $success['guest_name'] = $appointment->guest_name;
                $success['note'] = $appointment->note;
                $success['location'] = $appointment->location;
                $success['time'] = $appointment->time;
                $success['date'] = $appointment->date;
                $success['avatar'] = $appointment->avatar;
                $success['designation'] = $appointment->guest_designation;
            } else {
                $guest_info = User::find($appointment->guest_id)->first();
                $success['guest_name'] = $guest_info->name;
                $success['designation'] = $guest_info->designation;
                $success['avatar'] = $guest_info->avatar;
                $success['note'] = $appointment->note;
                $success['location'] = $appointment->location;
                $time = Carbon::parse($appointment->time);
                $date = Carbon::parse($appointment->date);
                $success['time'] = $time->format('g:i A');
                $success['date'] = $date->toFormattedDateString();

            }
            $results[] = $success;
        }
        return response()->json(['success' => $results], app('Illuminate\Http\Response')->status());

    }

    public function showAllAcceptedRequests()
    {
        $user = Auth::user();
        $appointments = Appointment::where('host_id', $user->id)
            ->where('appointment_status_id', 1)
            ->get();

//        dd($appointments);

        return response()->json(['success' => $appointments], app('Illuminate\Http\Response')->status());

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
