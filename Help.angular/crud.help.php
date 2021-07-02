<?php


// Rank route area
  Route::get('admin/getRank', ['as'=>'api.getRank','uses'=>'ApiAdminController@getRank']);
  Route::post('admin/createRank', ['as'=>'api.createRank','uses'=>'ApiAdminController@createRank']);
  Route::put('admin/updateRank', ['as'=>'api.updateRank','uses'=>'ApiAdminController@updateRank']);
  Route::delete('admin/deleteRank/{id}', ['as'=>'api.deleteRank','uses'=>'ApiAdminController@deleteRank'])->where(['id' => '[0-9]+']);
// Rank route area

// Rank crud area
  public function getRank()
  {

    $query = Rank::get();
    $results = $query->toArray();

    return response()->json($results,200,[],JSON_PRETTY_PRINT);
  }

  public function createRank(Request $request)
  {
    $rules  =  array(
      'name' => 'required'
    );
    
    $validator = Validator::make( $request->all(),$rules);

    if ($validator->fails())
    {
      $messages = $validator->errors();
      return response()->json($messages->all(),400,[],JSON_PRETTY_PRINT);
    }

    $rank = Rank::create($request->all());
    $returndata = ["Rank has been created successfully"];
    return response()->json($returndata, 200,[],JSON_PRETTY_PRINT); 
  }

  public function updateRank(Request $request)
  {
    $rules  =  array(
      'id' => 'required',
      'name' => 'required',
    );
    
    $validator = Validator::make( $request->all(),$rules);

    if ($validator->fails())
    {
      $messages = $validator->errors();
      return response()->json($messages->all(),400,[],JSON_PRETTY_PRINT);
    }

    $id = $request->get('id');
    $result = Rank::find($id);
    $result->name = $request->name;
    $result->save();
    //$update['name'] = $request->name;
    //$affected = DB::table('rankes')->where(['id'=>$request->id])->update($update);

    $returndata = ["Rank has been update successfully"];
    return response()->json($returndata, 200,[],JSON_PRETTY_PRINT);

  }


  public function deleteRank($id)
  {
    $result = Rank::find($id);
    if ($result === null)
    {
      $returndata = ["There is no rank with this id"];
      return response()->json($returndata, 400,[],JSON_PRETTY_PRINT);
    }

    $count = User::where('rank_id', $id)->count();

    if ($count > 0)
    {
      $returndata = ["This data can not be deleted due to related with other data"];
      return response()->json($returndata, 400,[],JSON_PRETTY_PRINT);
    }

    $result->delete();
    //$affected = DB::table('rankes')->where(['id'=>$request->id])->delete();
    $returndata = ["Congratulations ! Data has been deleted successfully"];
    return response()->json($returndata, 200,[],JSON_PRETTY_PRINT);
    
  }

// Rank crud area