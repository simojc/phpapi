<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Engmtpers;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EngmtpersController extends Controller
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
			$engmtpers = Engmtpers::all();

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers extraits avec succ�s.');
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
				'engmt_id'=> 'required',
				'pers_id'=> 'required',
				'exercice'=> 'required',
				'mont'=> 'required',
				'statut'=> 'required',
				'dtchgst'=> 'required',
				'message'=> 'required',
				'dt_ech'=> 'required'
			]);

			// $table->integer('engmt_id');
			// $table->integer('pers_id');		  // (fk vers table personne; contrainte: la personne doit �tre de type membre)
			// $table->integer('exercice');
			// $table->integer('mont');
			// $table->string('statut');
			// $table->string('dtchgst');
			// $table->string('message');
			// $table->dateTime('dt_ech');


			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$engmtpers = Engmtpers::create($input);

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers cr�� avec succ�s.');
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

			$engmtpers = Engmtpers::find($id);

			if (is_null($engmtpers)) {
				return $this->sendError('engmtpers non trouv�.');
			}

			return $this->sendResponse($engmtpers->toArray(), 'engmtpers r�cup�r avec succ�s .');
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

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers mis � jour avec succ�s.');
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

			return $this->sendResponse($engmtpers->toArray(), 'Engmtpers supprim� avec succ�s.');
		}
}
