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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string'
    //     ]);

    //     $booking = Booking::create([
    //         'title' => $request->title,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //     ]);

    //     $color = null;

    //     if($booking->title == 'Test') {
    //         $color = '#924ACE';
    //     }

    //     return response()->json([
    //         'id' => $booking->id,
    //         'start' => $booking->start_date,
    //         'end' => $booking->end_date,
    //         'title' => $booking->title,
    //         'color' => $color ? $color: '',

    //     ]);
    // }
    // public function update(Request $request ,$id)
    // {
    //     $booking = Booking::find($id);
    //     if(! $booking) {
    //         return response()->json([
    //             'error' => 'Unable to locate the event'
    //         ], 404);
    //     }
    //     $booking->update([
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //     ]);
    //     return response()->json('Event updated');
    // }
    // public function destroy($id)
    // {
    //     $booking = Booking::find($id);
    //     if(! $booking) {
    //         return response()->json([
    //             'error' => 'Unable to locate the event'
    //         ], 404);
    //     }
    //     $booking->delete();
    //     return $id;
    // }
}