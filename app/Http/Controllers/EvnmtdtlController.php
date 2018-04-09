<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Evnmtdtl;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EvnmtdtlController extends Controller
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
    $evnmtdtls = Evnmtdtl::all();
    return $evnmtdtls;

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
      'evnmt_id'=> 'required',
      'title'=> 'required',
      'resume'=> 'required'
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $evnmtdtl = Evnmtdtl::create($input);
    return = $evnmtdtl;

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

    $evnmtdtl = Evnmtdtl::find($id);

    if (is_null($evnmtdtl)) {
      return $this->sendError('detail non trouve.');
    }
    return $evnmtdtl;
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
   public function update(Request $request, Evnmtdtl $evnmtdtl)
  {
     // if (! $user = JWTAuth::parseToken()->authenticate()) {
      //    return response()->json(['msg' => 'User not found'], 404);
     //   }

    $input = $request->all();

    $validator = Validator::make($input, [
      'evnmt_id'=> 'required',
      'title'=> 'required',
      'resume'=> 'required'
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());
    }

      $evnmtdtl->evnmt_id = $input['evnmt_id'];
      $evnmtdtl->resume = $input['resume'];
      $evnmtdtl->title = $input['title'];

      $evnmtdtl->resp = $input['resp'];
      $evnmtdtl->contenu = $input['contenu'];
      $evnmtdtl->duree = $input['duree'];

      $evnmtdtl->save();

      return $evnmtdtl;

    // return $this->sendResponse($evnmts->toArray(), 'Evnmts mis a jour avec succes.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Evnmtdtl $evnmtdtl)
  {
    // if (! $user = JWTAuth::parseToken()->authenticate()) {
    // 	   return response()->json(['msg' => 'User not found'], 404);
    // }

    $evnmtdtl->delete();

    return $this->sendResponse($evnmtdtl->toArray(), 'detail supprime avec succes.');
  }
}
