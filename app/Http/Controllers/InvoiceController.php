<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\FileRequest;
use App\Models\Item;
use App\Models\Cart;
use Auth;

class InvoiceController extends Controller
{
    public $invoice_number = 1;

    public function viewInvoice(InvoiceRequest $request){
        $userID = Auth::user()->id;
        $address = $request->address_target;
        $post_code = $request->post_code_target;
        $invoice = $this->invoice_number;
        $carts = Cart::where('user_id', $userID)
            ->where('address', $address)
            ->where('post_code', $post_code)
            ->where('saved', 0)->get();
        return view('invoice', compact('carts', 'address', 'post_code', 'invoice', 'userID'));
    }

    public function saveInvoice(Request $request, $invoice){
        $userID = Auth::user()->id;
        $sum = $request->sum;
        $address = $request->address;
        $post_code = $request->post_code;
        Cart::where('user_id', $userID)
            ->where('address', $address)
            ->where('post_code', $post_code)
            ->where('saved', 0)
            ->update([
                'saved' => 1,
            ]);
        $carts = Cart::where('user_id', $userID)
            ->where('address', $address)
            ->where('post_code', $post_code)
            ->where('saved', 1)->get();
        $content = 'Invoice Number: '.$invoice."\n";
        $content .= 'User: '.Auth::user()->name."\n";
        $content .= 'Address: '.$address.' | '.$post_code."\n";
        $content .= 'Total: Rp. '.$sum."\n";
        $content .= "Items: \n";
        foreach($carts as $cart) {
            $content .= $cart->item->category->name."\n";
            $content .= $cart->item->name.' x'.$cart->item->quantity."\n";
            $content .= 'Rp. '.$cart->item->price*$cart->item->quantity."\n\n";
        }
        $fileName = 'i-'.$invoice.'-'.Auth::user()->name.'.txt';
        $filePath = storage_path('app/public/' . $fileName);
        $file = fopen($filePath, 'w');
        fwrite($file, $content);
        fclose($file);
        $header = array(
            'Content-Type: text/plain',
        );
        $this->invoice_number += 1;
        return response()->download($filePath, $fileName, $header);
    }
}
