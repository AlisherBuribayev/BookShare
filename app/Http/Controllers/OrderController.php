<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    public function order(Request $request)
    {              
        try {
            $user = Auth::user()->id;
            $carts = Cart::where('user_id', 'like', $user)->get();

            foreach ($carts as $cart) {
                $order = new Order;
                $order->address = $request->address;
                $order->user_id = $user;
                $order->book_id = $cart->book_id;
                $order->save();
            }
            $carts->each->delete();
            return response()->json([
                'is_success' => true,
                'message'    => 'Заказ принять'
            ]); 
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    }

    public function getOrders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.pages.orders', compact('orders'));
    }

    public function getUserOrders()
    {
        $user = Auth::user()->id;
       // $orders = Order::select('books.*')->with('book')->where('user_id', 'LIKE', $user)->paginate(6);
        $orders = Order::select([
            'books.*'
       ])->join('books','books.id', '=', 'orders.book_id')
           ->where('orders.user_id', 'LIKE', $user)->paginate(6);
        return response()->json([
            'data' => $orders
        ]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.pages.edit_order', \compact('order'));
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
        
        $order = Order::find($id);
        
        if($request->name){
            $order->name = $request->name;
        }
        if($request->user_id){
            $order->user_id = $request->user_id;
        }
        if($request->book_id){
            $order->book_id = $book_id;
        }
        if($request->status){
            $order->status =$request->status ;
        }
     

        $order->save(); 
        Session::flash('message', 'Category Updated Successfuly');
        Session::flash('alert-class', 'alert-success');
        
        return back();    
    }
   
     
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return back();
    }

}