<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Pers;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PersController extends BaseController
{
    /**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index(Request $request)
		 {

		$type = $request->input('type', '1');

			$email = $request->input('email','1');

			// $input = $request->all();

			 //	$email = $input['email'];
			//	if (!is_null($email)) {
			if (($type == '1') && ($email != '1')) {
			 		$perss = Pers::where( 'email', $email )->first();
				}

			//	if (!is_null($type)) {
					//$perss = Pers::where( 'type', $type )->first();

	    else {
					$perss = DB::select("
					SELECT
						pers.*, CONCAT(pers.nom , ' ', pers.prenom) nom_pers,
						CONCAT(locations.address , ' ',	locations.city, ' ',locations.country) location
					FROM pers
					LEFT JOIN locations ON locations.id = pers.location_id
					WHERE UPPER(substr(pers.type,1,1)) = $type");
				}

				if (is_null($perss)) {
					return $this->sendError('pers non trouve.');
				}

				return  $perss;
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
				'user_id'=> 'required',
				'type'=> 'required',
				'prenom'=> 'required',
				'sexe'=> 'required',
				'email'=> 'required',
				'telcel'=> 'required',
				'location_id'=> 'required',
				'type'=> 'required',
				'prenom'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$pers = Pers::create($input);

			return 	$pers;
			//$this->sendResponse($pers->toArray(), 'Pers cree avec succes.');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
		   // if (! $user = JWTAuth::parseToken()->authenticate()) {
			 //   return response()->json(['msg' => 'User not found'], 404);
		   // }

			$pers = Pers::find($id);

			if (is_null($pers)) {
				return $this->sendError('pers non trouve.');
			}

			return $pers;
			//$this->sendResponse($pers->toArray(), 'pers recuper avec succes .');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $mail
		 * @return \Illuminate\Http\Response
		 */
		public function show2($mail)
		{
			$pers = Pers::where( 'email', $email )->first();

			if (is_null($pers)) {
				return $this->sendError('pers non trouve.');
			}

			return  $pers;
			//$this->sendResponse($pers->toArray(), 'pers recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  Pers $pers
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Pers $pers)
		{
			 // if (! $user = JWTAuth::parseToken()->authenticate()) {
				//    return response()->json(['msg' => 'User not found'], 404);
			 //   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'user_id'=> 'required',
				'type'=> 'required',
				'prenom'=> 'required',
				'sexe'=> 'required',
				'email'=> 'required',
				'telcel'=> 'required',
				'location_id'=> 'required',
				'type'=> 'required',
				'prenom'=> 'required'
			]);


			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$pers->user_id = $input['user_id'];
				$pers->type = $input['type'];
				$pers->nom = $input['nom'];
				$pers->prenom = $input['prenom'];
				$pers->sexe = $input['sexe'];
				$pers->email = $input['email'];
				$pers->telcel = $input['telcel'];
				$pers->telres = $input['telres'];
				$pers->location_id = $input['location_id'];
				$pers->emploi = $input['emploi'];
				$pers->titre_adh = $input['titre_adh'];

				$pers->save();

				return $this->sendResponse($pers->toArray(), 'Pers mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  Pers $pers
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Pers $pers)
		{
			// if (! $user = JWTAuth::parseToken()->authenticate()) {
			// 	   return response()->json(['msg' => 'User not found'], 404);
			// }

			$pers->delete();

			return $this->sendResponse($pers->toArray(), 'Pers supprimee avec succes.');
		}
}
