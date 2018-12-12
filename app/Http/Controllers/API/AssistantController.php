<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
//        dd($user->id);

        foreach ($appointments as $appointment) {
//            dd($appointment->host_id);
            $is_ast_role = DB::table('user_roles')->where([['user_id', $user->id], ['role_id', 5]])->first();
//            dd($is_ast_role);
            $usr = User::find($appointment->host_id);
            if ($usr->organizations_id == $org_id_ast && !empty($is_ast_role)) {
                $res = Appointment::where([['date', Carbon::today()], ['appointment_status_id', 1]])->get();
                return response()->json(['success' => $res]);
            } else {
                return response()->json(['success' => "no data or not authorized!"]);
            }

        }

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
