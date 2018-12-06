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

//        $appointments = Appointment::where('host_id', $user->id)
//            ->where('appointment_status_id', 2)
//            ->orWhere('appointment_status_id', 4)
//            ->orderBy('date', 'asc')
//            ->orderBy('time', 'asc')
//            ->get();

        $appointments = Appointment::where('host_id', $user->id)
            ->whereIn('appointment_status_id', [2, 4])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

//        dd($appointments);

        $results = array();
        foreach ($appointments as $appointment) {
            if (empty($appointment->guest_id)) {
//                dd($appointment->name);
                $success['id'] = $appointment->id;
                $success['guest_name'] = $appointment->guest_name;
                $success['note'] = $appointment->note;
                $success['location'] = $appointment->location;
                $success['time'] = $appointment->time;
                $success['date'] = $appointment->date;
                $success['avatar'] = $appointment->avatar;
                $success['designation'] = $appointment->guest_designation;
            } else {
                $guest_info = User::find($appointment->guest_id)->first();
                $success['id'] = $appointment->id;
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

    public function showAllSentRequests()
    {
        $user = Auth::user();
        $appointments = Appointment::where('guest_id', $user->id)
            ->where('appointment_status_id', 2)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

//        dd($appointments);

        $results = array();
        foreach ($appointments as $appointment) {

            $host_info = User::find($appointment->host_id)->first();
            $success['host_name'] = $host_info->name;
            $success['designation'] = $host_info->designation;
            $success['avatar'] = $host_info->avatar;
            $success['note'] = $appointment->note;
            $success['location'] = $appointment->location;
            $time = Carbon::parse($appointment->time);
            $date = Carbon::parse($appointment->date);
            $success['time'] = $time->format('g:i A');
            $success['date'] = $date->toFormattedDateString();

            $results[] = $success;
        }
        return response()->json(['success' => $results], app('Illuminate\Http\Response')->status());

    }

    public function showAllAcceptedRequests()
    {
        $user = Auth::user();
//        $appointments = Appointment::where('host_id', $user->id)
//            ->orWhere('guest_id', $user->id)
//            ->where('appointment_status_id', 1)
//            ->orderBy('date', 'asc')
//            ->orderBy('time', 'asc')
//            ->get();

        $appointments = Appointment::where([['host_id', $user->id], ['appointment_status_id', 1]])
            ->orWhere([['guest_id', $user->id], ['appointment_status_id', 1]])
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $results = array();
        foreach ($appointments as $appointment) {
            if (empty($appointment->guest_id)) {
//                dd($appointment->name);
                $success['id'] = $appointment->id;
                $success['guest_name'] = $appointment->guest_name;
                $success['note'] = $appointment->note;
                $success['location'] = $appointment->location;
                $success['time'] = $appointment->time;
                $success['date'] = $appointment->date;
                $success['avatar'] = $appointment->avatar;
                $success['designation'] = $appointment->guest_designation;
            } else {
                $guest_info = User::find($appointment->guest_id)->first();
                $success['id'] = $appointment->id;
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

    public function updateRequests(Request $request)
    {
        $user = Auth::user();

        $data['id'] = $request->input('appointment_id');
        $status = $request->input('status');

        if ($status) {
            $response = Appointment::where('host_id', $user->id)
                ->where('id', $data['id'])
                ->update(['appointment_status_id' => 1]);

            if ($response) {
                return response()->json(['success' => 'accepted!']);
            } else {
                return response()->json(['success' => 'failed!']);
            }
        } else {
            $response = Appointment::where('host_id', $user->id)
                ->where('id', $data['id'])
                ->update(['appointment_status_id' => 3]);

            if ($response) {
                return response()->json(['success' => 'rejected!']);
            } else {
                return response()->json(['success' => 'failed!']);
            }

        }
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
