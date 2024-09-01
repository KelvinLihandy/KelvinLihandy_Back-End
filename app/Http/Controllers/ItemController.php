<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    //
    public function getCreatePage(){
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    public function createItem(ItemRequest $request){
        $category = Category::find($request->category_id);
        $request->merge(['category' => $category]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $request->name.'_'.$request->category->name.'.'.$extension;
        $request->file('image')->storeAs('public/image/', $fileName);
        Item::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=> $fileName,
            
        ]);
        return redirect(route('viewItemsPage'));
    }

    public function updateItem(ItemRequest $request, $id){
        $item = Item::find($id);
        $category = Category::find($request->category_id);
        $request->merge(['category' => $category]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $request->name.'_'.$request->category->name.'.'.$extension;
        $request->file('image')->storeAs('public/image/', $fileName);
        $item->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=> $fileName,
        ]);
        return redirect(route('viewItemsPage'));
    }
    
    public function getItemByID($id){
        $item = Item::find($id);
        $categories = Category::all();
        return view('update', compact('item', 'categories'));
    }

    public function deleteItem($id){
        Item::destroy($id);
        return redirect(route('viewItemsPage'));
    }

    public function getItems(){
        $items = Item::all();
        $categories = Category::all();
        return view('view', compact('items'));
    }
}
