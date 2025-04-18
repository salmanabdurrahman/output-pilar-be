<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => Car::with('galleries')->get()
        ]);
    }

    public function popular()
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => Car::withCount('bookings')->orderByDesc('bookings_count')->take(5)->get()
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => Car::with('galleries')->findOrFail($id)
        ]);
    }

    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->has('color')) {
            $query->where('color', '=', $request->color);
        }
        if ($request->has('status')) {
            $query->where('status', '=', $request->status);
        }

        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => $query->with('galleries')->get()
        ]);
    }
}
