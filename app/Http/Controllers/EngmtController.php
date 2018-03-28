<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Engmt;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EngmtController extends Controller
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
			$engmts = Engmt::all();

			return $this->sendResponse($engmts->toArray(), 'Engmts extraits avec succès.');
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
				'nom'=> 'required',
				'periodicite'=> 'required',
				'periode'=> 'required',
				'statut'=> 'required',
				'mont_unit'=> 'required',
				'totalper'=> 'required'
			]);

			// $table->integer('groupe_id');			
			// $table->string('nom');		 			
			// $table->string('descr');			
			// $table->string('periodicite');	
			// $table->string('periode');	
			// $table->string('statut');   ///--- valeurs: En cours, à venir, fermé selon la période
			// $table->integer('mont_unit');		
			// $table->integer('totalper');   /// solde période
			
			
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$engmt = ::create($input);

			return $this->sendResponse($engmt->toArray(), 'Engmt créé avec succès.');
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

			$engmt = Engmt::find($id);

			if (is_null($engmt)) {
				return $this->sendError('engmt non trouvé.');
			}

			return $this->sendResponse($engmt->toArray(), 'engmt récupér avec succès .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Engmt $engmt)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'groupe_id'=> 'required',
				'nom'=> 'required',
				'periodicite'=> 'required',
				'periode'=> 'required',
				'statut'=> 'required',
				'mont_unit'=> 'required',
				'totalper'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$engmt->groupe_id = $input['groupe_id'];
				$engmt->nom = $input['nom'];
				$engmt->periodicite = $input['periodicite'];
				$engmt->periode = $input['periode'];
				$engmt->statut = $input['statut'];

				$engmt->mont_unit = $input['mont_unit'];
				$engmt->totalper = $input['totalper'];
				
			 $engmt->save();

			return $this->sendResponse($engmt->toArray(), 'Engmt mis à jour avec succès.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Engmt $engmt)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$engmt->delete();

			return $this->sendResponse($engmt->toArray(), 'Engmt supprimé avec succès.');
		}
}
