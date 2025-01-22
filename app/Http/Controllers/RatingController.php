<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function screen($orderNumber)
    {
        return view('rating', compact('orderNumber'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_rating' => 'required|integer',
            'product_rating' => 'required|integer',
            'ambiance_rating' => 'required|integer',
            'return_response' => 'required|in:yes,no',
            'additional_comments' => 'nullable|string',
            'order_number' => 'required|string',
        ], [
            'required' => 'Zorunlu alanları doldurunuz.',
        ]);

        $validatedData['order_number'] = $request->order_number;

        Rating::create($validatedData);

        return redirect()->route('past.order.show', $request->order_number)->with('success', 'Anketiniz başarıyla kaydedildi.');
    }
}
