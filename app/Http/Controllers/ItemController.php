<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\ItemController;
use App\Http\Requests;
use App\Models\User;
use App\Models\Item;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id, $page)
    {
       
            return Item::where('user_id',$user_id)->forPage($page, 3)->orderBy('id','DESC')->get();
    
      
       
    }
    public function countall($user_id)
    {
         
            $allitems = Item::where('user_id',$user_id)->get();
         
           return count($allitems);
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
        $newItem = new Item;
        $newItem->user_id = $request->item["user_id"];
        $newItem->name = $request->item["name"];
        $newItem->desc = $request->item["desc"];
        $newItem->save();

        return $newItem;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $existingItem = Item::find($id);

        if($existingItem){
           
            return $existingItem;
        }
        return "Item not found!";
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
    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);

        if($existingItem){
            
            $existingItem->name = $request->item["name"];
            $existingItem->desc = $request->item["desc"];
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }
        return "Item not found!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find($id);

        if($existingItem){
            $existingItem->delete();
            return "Item successfully deleted!";
        }
        return "Item not found!";
    }
}
