<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Session;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class SessionController extends BaseController
{
    /**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		 {
		  if (! $user = JWTAuth::parseToken()->authenticate()) {
			 return response()->json(['msg' => 'User not found'], 404);
		 }
			$sessions = Session::all();

			return $this->sendResponse($sessions->toArray(), 'Sessions extraits avec succes.');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
		   if (! $user = JWTAuth::parseToken()->authenticate()) {
			   return response()->json(['msg' => 'User not found'], 404);
		   }
			$input = $request->all();

			$validator = Validator::make($input, [
				'name'=> 'required',
				'presenter'=> 'required',
				'duration'=> 'required',
				'level'=> 'required',
				'abstract'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$session = Session::create($input);

			return $this->sendResponse($session->toArray(), 'Session cree avec succes.');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
		   if (! $user = JWTAuth::parseToken()->authenticate()) {
			   return response()->json(['msg' => 'User not found'], 404);
		   }

			$session = Session::find($id);

			if (is_null($session)) {
				return $this->sendError('session non trouve.');
			}

			return $this->sendResponse($session->toArray(), 'session recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Session $session)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'name'=> 'required',
				'presenter'=> 'required',
				'duration'=> 'required',
				'level'=> 'required',
				'abstract'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$session->name = $input['name'];
				$session->presenter = $input['presenter'];
				$session->duration = $input['duration'];
				$session->level = $input['level'];
				$session->abstract = $input['abstract'];

			 $session->save();

			return $this->sendResponse($session->toArray(), 'Session mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Session $session)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$session->delete();

			return $this->sendResponse($session->toArray(), 'Session supprime avec succes.');
		}
}
