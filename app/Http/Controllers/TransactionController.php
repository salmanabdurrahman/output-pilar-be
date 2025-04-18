<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show($id)
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => Transaction::with('booking')->findOrFail($id)
        ]);
    }
}
