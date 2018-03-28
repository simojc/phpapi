<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Evnmt;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EvnmtController extends Controller
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
			$evnmts = Evnmt::all();

			return $this->sendResponse($evnmts->toArray(), 'evnmts extraits avec succès.');
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
				'descr'=> 'required',
				'date'=> 'required',
				'statut'=> 'required',
				'hrdeb'=> 'required',
				'location_id'=> 'required',				
			]);		
			
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$evnmts = ::create($input);

			return $this->sendResponse($evnmts->toArray(), 'Evnmts créé avec succès.');
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

			$evnmts = Evnmts::find($id);

			if (is_null($evnmts)) {
				return $this->sendError('evnmts non trouvé.');
			}

			return $this->sendResponse($evnmts->toArray(), 'evnmts récupér avec succès .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Evnmts $evnmts)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

			$validator = Validator::make($input, [
				'groupe_id'=> 'required',
				'nom'=> 'required',
				'descr'=> 'required',
				'date'=> 'required',
				'statut'=> 'required',
				'hrdeb'=> 'required',
				'location_id'=> 'required',				
			]);	

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}
			
				$evnmts->groupe_id = $input['groupe_id'];
				$evnmts->nom = $input['nom'];
				$evnmts->date = $input['date'];
				$evnmts->hrdeb = $input['hrdeb'];
				$evnmts->hrfin = $input['hrfin'];
				$evnmts->statut = $input['statut'];
				$evnmts->descr = $input['descr'];
				$evnmts->contenu = $input['contenu'];
				
				$evnmts->location_id = $input['location_id'];
				$evnmts->rapport = $input['rapport'];
				$evnmts->resp1 = $input['resp1'];
				$evnmts->resp2 = $input['resp2'];
				$evnmts->resp3 = $input['resp3'];
		
				$evnmts->affich = $input['affich'];
				
			 $evnmts->save();

			return $this->sendResponse($evnmts->toArray(), 'Evnmts mis à jour avec succès.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Evnmts $evnmts)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$evnmts->delete();

			return $this->sendResponse($evnmts->toArray(), 'Evnmts supprimé avec succès.');
		}
}

