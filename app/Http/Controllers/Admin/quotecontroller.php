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
            'status' => 'required|in:pending,approval_required,paid',
            'notes' => 'nullable|string|max:1000',
        ]);

        $quote->update($validated);

        return redirect()->back()->with('success', 'Quote updated successfully.');
    }
}