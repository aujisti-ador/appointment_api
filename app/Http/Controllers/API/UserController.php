<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Organization;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $successStatus = 200;


    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appointment_api')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], $this->successStatus);

        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',

            'email' => 'required|email',

            'password' => 'required',

            'c_password' => 'required|same:password',

        ]);


        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }


        $input = $request->all();

//        dd($input);

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] = $user->createToken('appointment_api')->accessToken;

        $success['name'] = $user->name;

        $success['email'] = $user->email;

        $success['designation'] = $user->designation;

        $success['mobile_no'] = $user->mobile_no;

        $success['gender'] = $user->gender;

        $success['avatar'] = $user->avatar;

        $success['org_info'] = Organization::find($user->organizations_id);


//        $temp = Organization::where('id', $user->organizations_id) ->first();

//        dd($temp);

//        $success['org_name'] = $temp->organizations_id;

//        dd($success);


        return response()->json(['success' => $success], $this->successStatus);

    }

    public function details()
    {
        $user = Auth::user();

        $success['name'] = $user->name;

        $success['email'] = $user->email;

        $success['designation'] = $user->designation;

        $success['org_info'] = Organization::find($user->organizations_id);

        $success['mobile_no'] = $user->mobile_no;

        $success['gender'] = $user->gender;

        $success['avatar'] = $user->avatar;

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function getAllUsers()
    {
        $user = User::all();
        return response()->json(['success' => $user], $this->successStatus);
    }


    public function logout()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
//        return response()->json(['success' => 'logged out successfully!'], 204);
        return response()->json(['success' => 'logout success'], 200);
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
