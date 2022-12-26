<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::all();

        return view('admin.pages.subscriptions', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.new_subscription');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscription = new Subscription;
        $subscription->name = $request->name;
        $subscription->money = $request->money;
        $subscription->term = $request->term;
    
        $subscription->save();

        Session::flash('message', 'Subscription Created Successfuly');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription = Subscription::find($id);
        return view('admin.pages.single_subscription', \compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription = Subscription::find($id);
        return view('admin.pages.edit_subscription', \compact('subscription'));
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
        $subscription = Subscription::find($id);
        if($request->name){
            $subscription->name = $request->name;
        }
        if($request->money){
            $subscription->money = $request->money;
        }
        if($request->term){
            $subscription->term = $request->term;
        }
        
        $subscription->save();
        Session::flash('message', 'Subscription Updated Successfuly');
        Session::flash('alert-class', 'alert-success');
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription = Subscription::find($id);
        $subscription->delete();
        Session::flash('message', 'Subscription Deleted Successfuly');
        Session::flash('alert-class', 'alert-success');
        return back();
    }


    public function getSubs()
    {
        try {
            $subs = Subscription::latest()->take(3)->get();
            
            return response()->json([
                'data'    => $subs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    } 
}