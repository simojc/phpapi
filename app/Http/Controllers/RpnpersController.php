<?php

namespace App\Http\Controllers;
use DB;

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
			$rpnperss = Rpnpers::all();
			return 	$rpnperss;
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
				'groupe_id'=> 'required',
				'pers_id'=> 'required',
				'repdt1_id'=> 'required',
				'dtadh'=> 'required',
				'mtrle'=> 'required'
				]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}
			$rpnpers = Rpnpers::create($input);
			return $rpnpers ;
			//$this->sendResponse($rpnpers->toArray(), 'Rpnpers cree avec succes.');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		 public function show($id)
		{

			$rpnpers = DB::select("
					SELECT
						rpnpers.*, CONCAT(personne.nom , ' ', personne.prenom) nom_pers,
						personne.prenom prenom_pers,
						CONCAT(repdt.nom , ' ', repdt.prenom) nom_repdt, repdt.prenom prenom_repdt,
  				CASE (rpnpers.depot - 10)<0
   						when true then 'Dépôt à compléter le plus tôt possible' END as  message
					FROM rpnpers
					LEFT JOIN pers as personne ON personne.id = rpnpers.pers_id
					LEFT JOIN pers as repdt ON repdt.id = rpnpers.repdt1_id
					WHERE rpnpers.repdt1_id = $id");

			if (is_null($rpnpers)) {
				return $this->sendError('rpnpers non trouve.');
			}

			return $rpnpers;
			//$this->sendResponse($rpnpers->toArray(), 'rpnpers recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		// public function update(Request $request, Rpnpers $rpnpers)
		{
			$input = $request->all();

			$validator = Validator::make($input, [
				'groupe_id'=> 'required',
				'pers_id'=> 'required',
				'repdt1_id'=> 'required',
				'dtadh'=> 'required',
				'mtrle'=> 'required'
				]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$rpnpers = Pers::findOrFail($id);
			$rpnpers->fill($request->all());

			$rpnpers->save();

			return $rpnpers ;
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Rpnpers $rpnpers)
		{
			$rpnpers->delete();

			return $this->sendResponse($rpnpers->toArray(), 'Rpnpers supprimee avec succes.');
		}
}
