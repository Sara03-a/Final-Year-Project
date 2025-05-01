<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'status' => 'required|in:approval_required,paid,payment_received',
            'notes' => 'nullable|string|max:1000',
            'total_price' => 'required|numeric|min:0'
        ]);

        $quote->update([
            'status' => $validated['status'],
            'notes' => $validated['notes'],
            'price' => $validated['total_price']
        ]);

        return redirect()->route('admin.quotes.show', $quote)->with('success', 'Quote updated successfully.');
    }
}