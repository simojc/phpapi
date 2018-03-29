<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Location;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LocationController extends Controller
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
			$locations = Location::all();

			return $this->sendResponse($locations->toArray(), 'Locations extraits avec succ�s.');
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
				'address'=> 'required',
				'city'=> 'required',
				'country'=> 'required'
			]);


			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$location = Location::create($input);

			return $this->sendResponse($location->toArray(), 'Location cr�� avec succ�s.');
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

			$location = Location::find($id);

			if (is_null($location)) {
				return $this->sendError('location non trouv�.');
			}

			return $this->sendResponse($location->toArray(), 'location r�cup�r avec succ�s .');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Location $location)
		{
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

				$validator = Validator::make($input, [
				'address'=> 'required',
				'city'=> 'required',
				'country'=> 'required'
			]);


			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$location->address = $input['address'];
				$location->city = $input['city'];
				$location->country = $input['country'];

			 $location->save();

			return $this->sendResponse($location->toArray(), 'Location mis � jour avec succ�s.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Location $location)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$location->delete();

			return $this->sendResponse($location->toArray(), 'Location supprim�e avec succ�s.');
		}
}
