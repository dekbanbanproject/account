<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function index_user(Request $request)
    { 
        $bookings = User::all();
         
        return view('user.index_user', ['bookings' => $bookings]);
    }
    public function index_admin(Request $request)
    { 
        $bookings = User::all();
         
        return view('admin.index_admin', ['bookings' => $bookings]);
    }
    
}