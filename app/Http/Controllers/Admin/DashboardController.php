<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function home()
    { 
        $users = User::latest()->paginate(10);
        return view('admin.pages.home', compact('users')); 
    }
}
