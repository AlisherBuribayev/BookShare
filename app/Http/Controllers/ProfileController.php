<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
    public function getUser()
    {
        try {
            $u =  Auth::user()->id;
            $user = User::find($u);
            $userSubs = Ticket::select('subscription_id')->where('user_id', 'LIKE', $u)->latest()->take(1)->get();
            $data['userInfo'] = $user;
        if ($userSubs)
             $data['userSubs'] = Subscription::select('name')->where('id', 'LIKE', $userSubs->first()->subscription_id)->get(); 
        else
            $data['userSubs'] = "Нет подписки" ;
        return response()->json([
            'data' => $data
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        } 
    }

    public function userUpdate($id)
    {                
        $user = User::find($id);
        
        if($request->name){
            $user->name = $request->name;
        }
        if($request->surname){
            $user->surname = $request->surname;
        }
        if($request->phone){
            $user->phone = $request->phone;
        }
        if($request->country){
            $user->country =$request->country ;
        }
        if($request->email){
            $user->email = $request->email;
        }
        $user->save();
        return back();
    }
}