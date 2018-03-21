<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Controllers\BaseController as BaseController;

use App\User;

use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

use App\Http\requests\RegisterFormRequest;

class AuthController extends Controller
{
    //The register method  will handle user registrations
      public function register(Request $request)
      {

        $this->validate($request, [
                'name' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|max:10',
               ]);

            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);

          if ($user->save()) {
                $user->signin = [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'email, password'
                ];
            $response = [
              'msg' => 'User created',
              'user' => $user
              ];

          return response()->json($response, 201);
        }

        $response = [
            'msg' => 'An error occurred'
          ];

          return response()->json($response, 404);
      }


    //  login method: it will handle the user logins
      public function login(Request $request)
      {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['msg' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['msg' => 'Could not create token'], 500);
        }

        return response()->json([
          'status' => 'success','
          token' => $token]
        );
    }

      // user method which will return current user information
      public function user(Request $request)
      {
          $user = User::find(Auth::user()->id);
          return response([
                  'status' => 'success',
                  'data' => $user
              ]);
      }


      //Here is the log-out method which will handle the logout requests.
      public function logout()
      {
          JWTAuth::invalidate();
          return response([
                  'status' => 'success',
                  'msg' => 'Logged out Successfully.'
              ], 200);
      }


      // method to check if the current token is valid or not and refresh the token if it is invalid.
    public function refresh()
    {
        return response([
         'status' => 'success'
        ]);
    }


}
