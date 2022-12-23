<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

class ItemController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $questions = Item::all();
    if (isset($questions)) {
      return $this->sendResponse($questions, 'Successfully retrieved all questions');
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
      'question' => 'required|string',
      'answer' => 'required|string',
      'choice_a' => 'required|string',
      'choice_b' => 'required|string',
      'choice_c' => 'required|string',
      'choice_d' => 'required|string',
      'test_id' => 'required',
    ]);

    $item = new Item();
    $item->fill($request->except(['creator_id']));
    $item->creator_id = $id;

    if ($item->save()) {
      return $this->sendResponse($item, 'Successfully added item');
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
    //
  }

  public function showByTest($id)
  {
    $questions = Item::where('test_id', $id)->get();

    if (isset($questions)) {
      return $this->sendResponse($questions, 'Successfully retrieved all questions');
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
  }

  public function search($keyword)
  {
    $items = Item::query()
      ->where('question', 'LIKE', "%{$keyword}%")
      ->orWhere('answer', 'LIKE', "%{$keyword}%")
      ->orWhere('choice_a', 'LIKE', "%{$keyword}%")
      ->orWhere('choice_b', 'LIKE', "%{$keyword}%")
      ->orWhere('choice_c', 'LIKE', "%{$keyword}%")
      ->orWhere('choice_d', 'LIKE', "%{$keyword}%")
      ->get();
    return $this->sendResponse($items, '');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $item = Item::where('id', $id);
    $item->delete();
    return $this->sendResponse($item, "Successfully deleted item");
  }
}
