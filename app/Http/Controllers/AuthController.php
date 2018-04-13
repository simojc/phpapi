<?php
namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
//use App\Http\Controllers\BaseController as BaseController;
use App\User;
use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

use App\Http\requests\RegisterFormRequest;

class AuthController extends Controller

{
      public function index()
		 {
			//$users1 = User::all();

      //$users3 = DB::table('users')->get();

      $users = DB::select("SELECT
               users.name, users.email, users.admin, users.groupe_id,
               groupes.nom, groupes.descr
               FROM users
               LEFT JOIN groupes
               ON groupes.id = users.groupe_id");
       //WHERE hash_card NOT IN ( SELECT orders.hash_card FROM orders )

			return $users;
			 //return $this->sendResponse($events->toArray(), 'Events extraits avec succes.');
		}

     //The register method  will handle user registrations
      public function register(Request $request)
      {
        $this->validate($request, [
                'name' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|max:10',
				        'groupe_id' => 'required'
               ]);

            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;

            $user->password = bcrypt($request->password);

			   // renseigner le groupe avec une variable globale dans le frontend Angular
			   $user->groupe_id = $request->groupe_id;

          if ($user->save()) {
                $user->signin = [
                //'href' => 'api/v1/user/signin',
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
        //
        $email = $request->email;
        $user = new User;

        //echo 'User is ' . $user->first_name . ' ' . $user->last_name;
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['msg' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['msg' => 'Could not create token'], 500);
        };

        $user = User::where( 'email', $email )->first();

        return response()->json([
          'status' => 'success','token' => $token, 'user' => $user,
        ]);

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


	/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		public function update(Request $request, User $util)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

			/*
				$validator = Validator::make($input, [
				'admin'=> 'admin'
				]);
			*/

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			  $util->admin = $input['admin'];

			 $util->save();

			return $this->sendResponse($util->toArray(), 'User mis a jour avec succes.');
		}

    public function refreshToken() {

        $token = \JWTAuth::getToken();

        if (! $token) {
            return response()->json(["error" => 'Token is invalid'], 401);
        }

        try {

            $refreshedToken = \JWTAuth::refresh($token);
            $user = \JWTAuth::setToken($refreshedToken)->toUser();

        } catch (JWTException $e) {

            return response()->json(["error" => $e->getMessage()], 400);
        }

        return response()->json(["token" => $refreshedToken, "user" => $user], 200);
    }


}
