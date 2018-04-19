<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Tontpers;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TontpersController extends BaseController
{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		 {
  	 	$tontperss = Tontpers::all();
			return $tontperss;
			//$this->sendResponse($tontperss->toArray(), 'Tontperss extraits avec succes.');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
		   // if (! $user = JWTAuth::parseToken()->authenticate()) {
			 //   return response()->json(['msg' => 'User not found'], 404);
		   // }
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

			return $tontpers;
			// $this->sendResponse($tontpers->toArray(), 'Tontpers cree avec succes.');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			$tontpers = DB::select("
				SELECT 	tontpers.*,
						tonts.nom,
						tonts.descr,
						tonts.mtpart,
						tonts.groupe_id,
						tonts.dtdeb,
						tonts.dtfin,
						tonts.cot_dern	,
						CONCAT(pers.nom , ' ', pers.prenom) nom_prenom
			FROM	tontpers
			LEFT JOIN tonts ON tonts.id = tontpers.tont_id
			LEFT JOIN pers ON pers.id = tontpers.pers_id
			WHERE tontpers.pers_id = $id ");

			//and tonts.groupe_id = $groupe_id

		//	$tontpers1 = tontpers::where( 'repdt_id', $id )->all();
		// 	$tontpers = Tontpers::find($id);
			if (is_null($tontpers)) {
				return $this->sendError('tontpers non trouve.');
			}

			return $tontpers;
			// $this->sendResponse($tontpers->toArray(), 'tontpers recuper avec succes .');
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
			 // if (! $user = JWTAuth::parseToken()->authenticate()) {
				//    return response()->json(['msg' => 'User not found'], 404);
			 //   }

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

			return $this->sendResponse($tontpers->toArray(), 'Tontpers mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Tontpers $tontpers)
		{
			// if (! $user = JWTAuth::parseToken()->authenticate()) {
			// 	   return response()->json(['msg' => 'User not found'], 404);
			// }
			$tontpers->delete();

			return $tontpers;
			// $this->sendResponse($tontpers->toArray(), 'Tontpers supprime avec succes.');
		}
}
