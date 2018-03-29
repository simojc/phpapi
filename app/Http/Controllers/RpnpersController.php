<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Rpnpers;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RpnpersController extends BaseController
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
			$rpnperss = Rpnpers::all();

			return $this->sendResponse($rpnperss->toArray(), 'Rpnpersonnes extraites avec succes.');
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
				'groupe_id'=> 'required',
				'pers_id'=> 'required',
				'repdt_id'=> 'required',
				'dtadh'=> 'required',
				'mtrle'=> 'required',
				'depot'=> 'required',
				'dtmajdpt'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$rpnpers = Rpnpers::create($input);

			return $this->sendResponse($rpnpers->toArray(), 'Rpnpers cree avec succes.');
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

			$rpnpers = Rpnpers::find($id);

			if (is_null($rpnpers)) {
				return $this->sendError('rpnpers non trouve.');
			}

			return $this->sendResponse($rpnpers->toArray(), 'rpnpers recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Rpnpers $rpnpers)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'groupe_id'=> 'required',
				'pers_id'=> 'required',
				'repdt_id'=> 'required',
				'dtadh'=> 'required',
				'mtrle'=> 'required',
				'depot'=> 'required',
				'dtmajdpt'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$rpnpers->groupe_id = $input['groupe_id'];
			$rpnpers->pers_id = $input['pers_id'];
			$rpnpers->repdt_id = $input['repdt_id'];
			$rpnpers->dtadh = $input['dtadh'];
			$rpnpers->mtrle = $input['mtrle'];
			$rpnpers->depot = $input['depot'];
			$rpnpers->dtmajdpt = $input['dtmajdpt'];

			$rpnpers->save();

			return $this->sendResponse($rpnpers->toArray(), 'Rpnpers mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Rpnpers $rpnpers)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$rpnpers->delete();

			return $this->sendResponse($rpnpers->toArray(), 'Rpnpers supprimee avec succes.');
		}
}
