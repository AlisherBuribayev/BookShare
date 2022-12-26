<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function getCart()
    {
         try {
            $user = Auth::user()->id;
        $cart = Cart::with('book')->where('user_id', 'like', $user)->take(10)->get();
        
        return response()->json([
            'data'    => $cart
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        } 
    }
    
    
    public function addToCart($id)
    {
        try {
            $cart = new Cart;
            $book = Book::find($id);
            $user =  Auth::user()->id;
            $cart->user_id = $user;
            $cart->book_id = $id;
            $cart->save();
            
            return response()->json([
                'is_success' => true,
                'message'    => 'Книга успешно добавлено в корзину.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]); 
        }
    }
    
    
    public function destroy($id)
    {
        $cart = Cart::where('book_id', 'like', $id)
        ->where('user_id', 'LIKE',Auth::user()->id)->delete();
        return response()->json([
            'is_success' => true
        ]);
    }

    public function removeAll($id)
    {
        $cart = Cart::where('user_id', 'LIKE',Auth::user()->id)->delete();
        return back();
    }
}