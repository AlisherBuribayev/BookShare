<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;


class UserSubscriptionController extends Controller
{
    /* public function getSubs()
    {

        $user = Auth::user()->id;
            $subs = Ticket::where('user_id', 'like', $user)->latest()->get();
            
            return response()->json([
                'data'    => $subs
            ]);
        try {
            $user = Auth::user()->id;
            $subs = Ticket::where('user_id', 'like', $user)->latest()->get();
            
            return response()->json([
                'data'    => $subs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    } */
    
    
    public function addSubs($id)
    {
        
        try {
            $user =  Auth::user()->id;
            $subs = new Ticket;
            $subs->user_id = $user;
            $subs->subscription_id = $id;
            $subs->address = 'd';
            $subs->save();
            
            return response()->json([
                'is_success' => true,
                'message'    => 'Абонемент успешно зарегистрировать!!! '
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    }
}