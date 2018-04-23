<?php

namespace App\Http\Controllers;
use DB;

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
  public function index(Request $request)
   {
    $input = $request->all();
     $evnmt_id = $input['evnmt_id'];

    if (!is_null($evnmt_id)) {
      //  $evnmtdtls = Evnmtdtl::where('evnmt_id', $evnmt_id)->get();
        $evnmtdtls = DB::select("
          SELECT 	evnmtdtls.*,
              CONCAT('Point ',evnmtdtls.ordre , ': ', evnmtdtls.title) entete
        FROM	evnmtdtls
        WHERE evnmtdtls.evnmt_id = $evnmt_id ");
      }

    else {
        $evnmtdtls = Evnmtdtl::all();
      }

      if (is_null($evnmtdtls)) {
        return $this->sendError('evnmtdtls non trouve.');
      }

      return  $evnmtdtls;
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
      'evnmt_id'=> 'required',
      'title'=> 'required',
      'ordre'=> 'required',
      'resume'=> 'required'
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $evnmtdtl = Evnmtdtl::create($input);
    return $evnmtdtl;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $evnmtdtl = Evnmtdtl::find($id);

    if (is_null($evnmtdtl)) {
      return $this->sendError('detail non trouve.');
    }
    return $evnmtdtl;
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
    $input = $request->all();

    $validator = Validator::make($input, [
      'evnmt_id'=> 'required',
      'title'=> 'required',
      'ordre'=> 'required',
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
      $evnmtdtl->ordre = $input['ordre'];
      $evnmtdtl->save();

      return $evnmtdtl;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Evnmtdtl $evnmtdtl)
  {
    $evnmtdtl->delete();

    return $this->sendResponse($evnmtdtl->toArray(), 'detail supprime avec succes.');
  }

}
