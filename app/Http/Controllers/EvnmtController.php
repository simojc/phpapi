<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Evnmt;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EvnmtController extends BaseController
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
			$evnmts = Evnmt::all();
			return $evnmts;

			// return $this->sendResponse($evnmts->toArray(), 'evnmts extraits avec succes.');
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

			$evnmt = Evnmt::create($input);
			return  $evnmt;

			// return $this->sendResponse($evnmts->toArray(), 'Evnmts cree avec succes.');
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

			$evnmt = Evnmt::find($id);

			if (is_null($evnmt)) {
				return $this->sendError('evnmt non trouve.');
			}
			return $evnmt;
			// return $this->sendResponse($evnmts->toArray(), 'evnmts recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Evnmt $evnmt)
		{
			 // if (! $user = JWTAuth::parseToken()->authenticate()) {
				//    return response()->json(['msg' => 'User not found'], 404);
			 //   }

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

				$evnmt->groupe_id = $input['groupe_id'];
				$evnmt->nom = $input['nom'];
				$evnmt->hrdeb = $input['hrdeb'];
				$evnmt->hrfin = $input['hrfin'];
				$evnmt->statut = $input['statut'];
				$evnmt->descr = $input['descr'];
				$evnmt->contenu = $input['contenu'];

				$evnmt->location_id = $input['location_id'];
				$evnmt->rapport = $input['rapport'];
				$evnmt->resp1 = $input['resp1'];
				$evnmt->resp2 = $input['resp2'];
				$evnmt->resp3 = $input['resp3'];

				$evnmt->affich = $input['affich'];

			 $evnmt->save();

			 return $evnmt;

			// return $this->sendResponse($evnmts->toArray(), 'Evnmts mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Evnmt $evnmt)
		{
			// if (! $user = JWTAuth::parseToken()->authenticate()) {
			// 	   return response()->json(['msg' => 'User not found'], 404);
			// }

			$evnmt->delete();

			return $this->sendResponse($evnmt->toArray(), 'Evnmt supprime avec succes.');
		}
}
