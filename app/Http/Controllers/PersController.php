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

			$groupe = $request->input('groupe','1');

			if (($type == '1') && ($email == '1')) {
					$perss = Pers::all();
				}
			elseif (($type == '1') && ($email != '1')) {
			 		$perss = Pers::where( 'email', $email )->first();
				}
			else {
					$perss = DB::select("
					SELECT
						pers.*, CONCAT(pers.nom , ' ', pers.prenom) nom_pers,
						CONCAT(pers.address , ' ',	pers.city, ' ',pers.country) location
					FROM pers
					WHERE UPPER(substr(pers.type,1,1)) = $type and pers.groupe_id = $groupe");
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

			$input = $request->all();

			$validator = Validator::make($input, [
				'type'=> 'required',
				'prenom'=> 'required',
				'sexe'=> 'required',
				'email'=> 'required',
				'telcel'=> 'required',
				'address'=> 'required',
				'city'=> 'required',
				'country'=> 'required',
				'type'=> 'required',
				'prenom'=> 'required',
				'groupe_id'=> 'required',
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

			$pers = Pers::find($id);

			if (is_null($pers)) {
				return $this->sendError('pers non trouve.');
			}

			return $pers;
			//$this->sendResponse($pers->toArray(), 'pers recuper avec succes .');
		}



		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  Pers $pers
		 * @return \Illuminate\Http\Response
		 */
		// public function update(Request $request, Pers $pers)
		public function update(Request $request, $id)
		{
			$input = $request->all();
			$validator = Validator::make($input, [
				'type'=> 'required',
				'nom'=> 'required',
				'sexe'=> 'required',
				'email'=> 'required',
				'telcel'=> 'required',
				'address'=> 'required',
				'city'=> 'required',
				'country'=> 'required',
				'type'=> 'required',
				'prenom'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}
			$pers = Pers::findOrFail($id);
			$pers->fill($request->all());
			$pers->save();
			return $pers ;
			//this->sendResponse($pers->toArray(), 'Pers mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  Pers $pers
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Pers $pers)
		{

			$pers->delete();

			return $this->sendResponse($pers->toArray(), 'Personne supprimée avec succes.');
		}
}
