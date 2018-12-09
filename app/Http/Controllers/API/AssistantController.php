<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AssistantController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function showTodaysAppointments()
    {
        $user = Auth::user();

        $appointments = Appointment::where([['date', Carbon::today()], ['appointment_status_id', 1]])->get();

        $org_id_ast = $user->organizations_id;

//        dd($appointments->host_id);
//        dd($ast_id);

        foreach ($appointments as $appointment) {
//            dd($appointment->host_id);
            $usr = User::find($appointment->host_id);
            if ($usr->organizations_id == $org_id_ast) {
                $res = Appointment::where([['date', Carbon::today()], ['appointment_status_id', 1]])->get();
                return response()->json(['success' => $res]);
            } else {
                return response()->json(['success' => "no data!"]);
            }

        }




//        if ($user->organizations_id == $result-> organizations_id) {
//            $res = Appointment::where([['date', Carbon::today()], ['appointment_status_id', 1]])->get();
//            return response()->json(['success' => $res]);
//        } else {
//            return response()->json(['success' => "no data!"]);
//        }

//        return response()->json(['success' => $data]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}