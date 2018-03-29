<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Tontpers;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TontpersController extends Controller
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
			$tontperss = Tontpers::all();

			return $this->sendResponse($tontperss->toArray(), 'Tontperss extraits avec succ�s.');
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
				'tont_id'=> 'required',
				'pers_id'=> 'required',
				'position'=> 'required',
				'alias'=> 'required',
				'statut'=> 'required',
				'dt_statut'=> 'required',
				'comment'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$tontpers = Tontpers::create($input);

			return $this->sendResponse($tontpers->toArray(), 'Tontpers cr�� avec succ�s.');
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

			$tontpers = Tontpers::find($id);

			if (is_null($tontpers)) {
				return $this->sendError('tontpers non trouv�.');
			}

			return $this->sendResponse($tontpers->toArray(), 'tontpers r�cup�r avec succ�s .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		public function update(Request $request, Tontpers $tontpers)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

			$validator = Validator::make($input, [
				'tont_id'=> 'required',
				'pers_id'=> 'required',
				'position'=> 'required',
				'alias'=> 'required',
				'statut'=> 'required',
				'dt_statut'=> 'required',
				'comment'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$tontpers->tont_id = $input['tont_id'];
			$tontpers->pers_id = $input['pers_id'];
			$tontpers->position = $input['position'];
			$tontpers->alias = $input['alias'];
			$tontpers->statut = $input['statut'];
			$tontpers->comment = $input['comment'];
			$tontpers->dt_statut = $input['dt_statut'];

			$tontpers->save();

			return $this->sendResponse($tontpers->toArray(), 'Tontpers mis � jour avec succ�s.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Tontpers $tontpers)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$tontpers->delete();

			return $this->sendResponse($tontpers->toArray(), 'Tontpers supprim� avec succ�s.');
		}
}
