<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Validator;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
       return response()->json($items);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'text'=>'required',
        ];
        
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            $response=array('response'=>$validator->messages(),'success'=>false);
            return $response;
        }else{
            $item=new Item();
            $item->text=$request->text;
            $item->body=$request->body;
            $item->save();
            return response()->json($item);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=Item::findOrFail($id);
        return response()->json($item);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules=[
            'text'=>'required',
        ];
        
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            $response=array('response'=>$validator->messages(),'success'=>false);
            return $response;
        }else{
            $item=Item::findOrFail($id);
            $item->text=$request->text;
            $item->body=$request->body;
            $item->save();
            return response()->json($item);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::findOrFail($id);
        $item->delete();
        $response=array('response'=>'Item deleted !!','success'=>true);

        return $response;
    }
}
