	<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Controllers\BaseController as BaseController;
	use App\Models\Event;
	use Validator;
	use JWTAuth;
	use Tymon\JWTAuth\Exceptions\JWTException;

	class EventController extends Controller
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
			$events = Event::all();

			return $this->sendResponse($events->toArray(), 'Events extraits avec succès.');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
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
				'name'=> 'required',
				'date'=> 'required',
				'time'=> 'required',
				'price'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

			$event = Product::create($input);

			return $this->sendResponse($events->toArray(), 'Event créé avec succès.');
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

			$event = Event::find($id);

			if (is_null($event)) {
				return $this->sendError('event non trouvé.');
			}

			return $this->sendResponse($event->toArray(), 'event récupér avec succès .');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			//
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
			 if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			   }

			$input = $request->all();

			  $validator = Validator::make($input, [
				'name'=> 'required',
				'date'=> 'required',
				'time'=> 'required',
				'price'=> 'required'
			]);

			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
			}

				$event->name = $input['name'];
				$event->date = $input['date'];
				$event->time = $input['time'];
				$event->price = $input['price'];
				$event->imageUrl = $input['imageUrl'];    
				$event->onlineUrl = $input['onlineUrl']; 

			 $event->save();

			return $this->sendResponse($event->toArray(), 'Event mis à jour avec succès.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Event $event)
		{
			if (! $user = JWTAuth::parseToken()->authenticate()) {
				   return response()->json(['msg' => 'User not found'], 404);
			}

			$event->delete();

			return $this->sendResponse($event->toArray(), 'Event supprimé avec succès.');
		}
	}
