<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;

class RecordController extends Controller
{

    public function index(){
      return  auth()->user()->records;

      $records = auth()->user()->records;
      //$products = auth()->user()->products;
      return response()->json([
        'success'=>true,
        'data'=>$records,
      ]);

    }

    public function store(){
      $record = new Record();
      $record->time_in = date('Y-m-d H:i:s');

      if (auth()->user()->records()->save($record) ) {
        return response()->json([
          'success'=>true,
          'data'=>$record->toArray(),
        ]);
      }else{
        return response()->json([
            'success'=>false,
            'data'=>'Something went wrong',
        ],500);
      }

    }

    public function update($id){
    //  return 1;
      $product = auth()->user()->records()->findOrFail($id);

      $product->update([
          'time_out'=>date('Y-m-d H:i:s'),
      ]);

      return response()->json([
        'success'=>true,
        'message'=>'Update success',
      ]);

    }

    public function state(){
      return '1';
    }

    //
}
