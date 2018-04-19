<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Tont;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TontController extends BaseController
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
			$tonts = Tont::all();

			return $this->sendResponse($tonts->toArray(), 'Tonts extraits avec succes.');
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
				'nom'=> 'required',
				'descr'=> 'required',
				'mtpart'=> 'required',
				'dtdeb'=> 'required',
				'dtfin'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$tont = Tont::create($input);

			return $tont;
			// $this->sendResponse($tont->toArray(), 'Tont cree avec succes.');
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

			$tont = Tont::find($id);

			if (is_null($tont)) {
				return $this->sendError('tont non trouve.');
			}

			return $tont;
			//$this->sendResponse($tont->toArray(), 'tont recuper avec succes .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Tont $tont)
		{
			 // if (! $user = JWTAuth::parseToken()->authenticate()) {
				//    return response()->json(['msg' => 'User not found'], 404);
			 //   }

			$input = $request->all();

			$validator = Validator::make($input, [
				'groupe_id'=> 'required',
				'nom'=> 'required',
				'descr'=> 'required',
				'mtpart'=> 'required',
				'dtdeb'=> 'required',
				'dtfin'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$tont->groupe_id = $input['groupe_id'];
			$tont->nom = $input['nom'];
			$tont->descr = $input['descr'];
			$tont->mtpart = $input['mtpart'];
			$tont->dtdeb = $input['dtdeb'];
			$tont->dtfin = $input['dtfin'];
			$tont->cot_dern = $input['cot_dern'];

			 $tont->save();

			return $this->sendResponse($tont->toArray(), 'Tont mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Tont $tont)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$tont->delete();

			return $this->sendResponse($tont->toArray(), 'Tont supprime avec succes.');
		}
}
