<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;

class TestController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tests = Test::all();
    if (isset($tests)) {
      return $this->sendResponse($tests, 'Successfully retrieved tests');
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    $request->validate([
      'test_name' => 'required|string',
      'time_limit' => 'required|string',
      'test_description' => 'required|string',
      'subject_id' => 'required'
    ]);

    $test = new Test();
    $test->fill($request->except(['creator_id', 'subject_id']));
    $test->creator_id = $id;
    $test->subject_id = $request['subject_id'];

    if ($test->save()) {
      return $this->sendResponse($test, 'Successfully added test');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $tests = Test::where('creator_id', $id)->get();
    if (isset($tests)) {
      return $this->sendResponse($tests, 'Successfully retrieved all tests');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
