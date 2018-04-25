<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Event;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

	class EventController extends BaseController
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		  {
					 //   if (! $user = JWTAuth::parseToken()->authenticate()) {
						//   return response()->json(['msg' => 'User not found'], 404);
					 // }
			$events = Event::all();

			return $events;

			//return $this->sendResponse($events->toArray(), 'Events extraits avec succes.');
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
			'name'=> 'required',
			'date'=> 'required',
			'time'=> 'required',
			'price'=> 'required',
				'address'=> 'required',
				'city'=> 'required',
				'country'=> 'required',			
		]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$event = Event::create($input);
			//return $event;
			return $this->sendResponse($event->toArray(), 'Event cree avec succes.');
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
			$event = Event::find($id);

			if (is_null($event)) {
				return $this->sendError('event non trouve.');
			}

			return $event;
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		//public function update(Request $request, $id)
		 public function update(Request $request, Event $event)
		{
			 // if (! $user = JWTAuth::parseToken()->authenticate()) {
				//    return response()->json(['msg' => 'User not found'], 404);
			 //   }

			$input = $request->all();

				$validator = Validator::make($input, [
			'name'=> 'required',
			'date'=> 'required',
			'time'=> 'required',
			'price'=> 'required',
				'address'=> 'required',
				'city'=> 'required',
				'country'=> 'required',			
		]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$event->name = $input['name'];
				$event->date = $input['date'];
				$event->time = $input['time'];
				$event->price = $input['price'];
				
				$event->address = $input['address'];
				$event->city = $input['city'];
				$event->country = $input['country'];
				
				$event->imageUrl = $input['imageUrl'];
				$event->onlineUrl = $input['onlineUrl'];

			 $event->save();

			 return $event;

			// return $this->sendResponse($event->toArray(), 'Event mis a jour avec succes.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Event $event)
		{
			// if (! $user = JWTAuth::parseToken()->authenticate()) {
			// 	   return response()->json(['msg' => 'User not found'], 404);
			// }

			$event->delete();

			return $this->sendResponse($event->toArray(), 'Event supprime avec succes.');
		}
	}
