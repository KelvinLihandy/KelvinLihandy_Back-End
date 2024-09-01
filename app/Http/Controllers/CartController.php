<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Http\Requests\CartRequest;
use Auth;

class CartController extends Controller
{
    //
    public function viewCart(){
        $items = Item::all();
        $userID = Auth::user()->id;
        $carts = Cart::where('user_id', $userID)->where('saved', 0)->get();
        // $address_address = Cart::pluck('address')->unique();
        // $post_code_post_code = Cart::pluck('post_code')->unique();
        return view('cart', compact('items', 'carts'/*, 'address_address', 'post_code_post_code'*/));
    }

    public function addCart(CartRequest $request){
        $item = Item::find($request->item_id)
            ->decrement('quantity', $request->quantity);
        Cart::create([
            'saved' => 0,
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'address' => $request->address,
            'post_code' => $request->post_code,
        ]);
        return redirect(route('cartPage'));
    }
}
