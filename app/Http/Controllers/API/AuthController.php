<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
     /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
    //     $data =  Request::except(array('_token'));

    //     $rule=array(
    //             'email' => 'required|email',
    //             'password' => 'required'
    //              );

    //      $validator = Validator::make($data,$rule);

    //     if ($validator->fails())
    //     {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'validation error',
    //             'errors' => $validator->errors()
    //         ], 401);
    //      }

    //     $credentials = $request->only('email', 'password');

    //     $remember_me = $request->has('remember') ? true : false;

    //      if (Auth::attempt($credentials, $remember_me)) {

    //         if(Auth::user()->status=='0'){
    //             Auth::logout();
    //             //return array("errors" => 'You account has been banned!');
    //             return redirect('/login')->withErrors(trans('words.account_banned'));
    //         }

    //         return $this->handleUserWasAuthenticated($request);
    //     }

    //    // return array("errors" => 'The email or the password is invalid. Please try again.');

    //     $user = User::where('email', $request->email)->first();

    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $user->$user->createToken("API TOKEN")->plainTextToken,
                'type' => 'bearer',
            ]
        ]);
    }

    return response()->json([
        'message' => 'Invalid credentials',
    ], 401);




    }


}
