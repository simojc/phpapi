<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Groupe;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class GroupeController extends BaseController
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
			$groupes = Groupe::all();

			return  $groupes;

			// return  $this->sendResponse($groupes->toArray(), 'Groupes extraits avec succes.');
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
				'nom'=> 'required',
				'mtle_reg'=> 'required',
				'descr'=> 'required',
				'dtcre'=> 'required',
				'dureexo'=> 'required',

				'dbexo'=> 'required',
				'cfinexo'=> 'required',
				'dureexo'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$groupe = Groupe::create($input);
			return $groupe;

			// return $this->sendResponse($groupe->toArray(), 'Groupe cree avec succes.');
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

			$groupe = Groupe::find($id);

			if (is_null($groupe)) {
				return $this->sendError('groupe non trouve.');
			}

				return $groupe;

			return $this->sendResponse($groupe->toArray(), 'groupe recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Groupe $groupe)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'nom'=> 'required',
				'mtle_reg'=> 'required',
				'descr'=> 'required',
				'dtcre'=> 'required',
				'dureexo'=> 'required',

				'dbexo'=> 'required',
				'cfinexo'=> 'required',
				'dureexo'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$groupe->nom = $input['nom'];
				$groupe->mtle_reg = $input['mtle_reg'];
				$groupe->descr = $input['descr'];
				$groupe->dtcre = $input['dtcre'];

				$groupe->dureexo = $input['dureexo'];
				$groupe->dbexo = $input['dbexo'];
				$groupe->cfinexo = $input['cfinexo'];

				$groupe->contact = $input['contact'];
				$groupe->location_id = $input['location_id'];
				$groupe->tel = $input['tel'];


			 $groupe->save();

			return $this->sendResponse($groupe->toArray(), 'Groupe mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Groupe $groupe)
		{
			// if (! $user = JWTAuth::parseToken()->authenticate()) {
			// 	   return response()->json(['msg' => 'User not found'], 404);
			// }

			$groupe->delete();

			 return $this->sendResponse($groupe->toArray(), 'Groupe supprime avec succes.');
		}
}
