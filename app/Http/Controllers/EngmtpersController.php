<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Engmtpers;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EngmtpersController extends BaseController
{
    /**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		 {
		 //  if (! $user = JWTAuth::parseToken()->authenticate()) {
			//  return response()->json(['msg' => 'User not found'], 404);
		 // }
			$engmtpers = Engmtpers::all();

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers extraits avec succes.');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{

			$input = $request->all();

			$validator = Validator::make($input, [
				'engmt_id'=> 'required',
				'pers_id'=> 'required',
				'exercice'=> 'required',
				'mont'=> 'required',
				'statut'=> 'required',
				'dtchgst'=> 'required',
				'message'=> 'required',
				'dt_ech'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$engmtpers = Engmtpers::create($input);

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers cree avec succes.');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			$engmtpers = DB::select("
					SELECT 	engmtpers.*,
							engmts.groupe_id,
							engmts.nom as nom_engmt,
							engmts.descr,
							engmts.periodicite,
							engmts.periode,
							engmts.statut as stat_engmt,
							engmts.mont_unit,
							engmts.dt_ech,
							CONCAT(pers.nom , ' ', pers.prenom) nom_prenom
					FROM	engmtpers
					LETF JOIN engmts ON engmts.id = engmtpers.engmt_id
					LEFT JOIN pers  ON pers.id = engmtpers.pers_id
					WHERE engmtpers.pers_id = $id ");

			//and engmts.groupe_id = $groupe_id

			//$engmtpers = Engmtpers::find($id);

			if (is_null($engmtpers)) {
				return $this->sendError('engmtpers non trouve.');
			}

			return $engmtpers;
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Engmtpers $engmtpers)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'engmt_id'=> 'required',
				'pers_id'=> 'required',
				'exercice'=> 'required',
				'mont'=> 'required',
				'statut'=> 'required',
				'dtchgst'=> 'required',
				'message'=> 'required',
				'dt_ech'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$engmtpers->engmt_id = $input['engmt_id'];
				$engmtpers->pers_id = $input['pers_id'];
				$engmtpers->exercice = $input['exercice'];
				$engmtpers->mont = $input['mont'];
				$engmtpers->statut = $input['statut'];
				$engmtpers->dtchgst = $input['dtchgst'];
				$engmtpers->message = $input['message'];
				$engmtpers->dt_ech = $input['dt_ech'];

				$engmtpers->save();

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Engmtpers $engmtpers)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$engmtpers->delete();

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers supprime avec succes.');
		}
}
