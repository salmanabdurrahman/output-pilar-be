<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'booking_date' => 'required|date',
            'duration_days' => 'required|integer|min:1'
        ]);

        $user = $request->user();

        $booking = Booking::create([
            'user_id' => $user->id,
            'car_id' => $request->car_id,
            'booking_date' => $request->booking_date,
            'duration_days' => $request->duration_days
        ]);

        $amount = Car::find($request->car_id)->price * $request->duration_days;

        $booking->transaction()->create(['amount' => $amount]);

        Car::where('id', '=', $request->car_id)->update(['status' => 'booked']);

        return response()->json([
            'message' => 'Booking created',
            'code' => 201,
            'data' => $booking->load(['transaction', 'car'])
        ], 201);
    }

    public function show($id)
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => Booking::with(['car', 'transaction'])->findOrFail($id)
        ]);
    }
}
