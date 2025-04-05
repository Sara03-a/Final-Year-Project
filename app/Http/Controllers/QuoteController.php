<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Address;
use App\Models\Measurement;
use App\Models\Carpet;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        $measurements = Measurement::where('user_id', auth()->id())->get();
        $carpets = Carpet::all();
        
        return view('quotes.create', compact('addresses', 'measurements', 'carpets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'measurement_id' => 'nullable|exists:measurements,id',
            'carpet_type' => 'required|in:existing,custom',
            'carpet_id' => 'required_if:carpet_type,existing|exists:carpets,id',
            'custom_carpet_description' => 'required_if:carpet_type,custom|nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        $notes = $request->input('notes', null);

        $quote = new Quote();
        $quote->user_id = auth()->id();
        $quote->address_id = $validated['address_id'];
        $quote->measurement_id = $validated['measurement_id'];
        $quote->carpet_id = $request->input('carpet_id');
        $quote->notes = $notes;
        $quote->status = 'pending';
        $quote->save();

        return redirect()->route('quotes.index')
            ->with('success', 'Quote request submitted successfully!');
    }

    public function show(Quote $quote)
    {
        if ($quote->user_id !== auth()->id()) {
            abort(403);
        }
        return view('quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        if ($quote->user_id !== auth()->id()) {
            abort(403);
        }
        $addresses = Address::where('user_id', auth()->id())->get();
        $measurements = Measurement::where('user_id', auth()->id())->get();
        $carpets = Carpet::all();
        return view('quotes.edit', compact('quote', 'addresses', 'measurements', 'carpets'));
    }

    public function update(Request $request, Quote $quote)
    {
        if ($quote->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'measurement_id' => 'nullable|exists:measurements,id',
            'carpet_type' => 'required|in:existing,custom',
            'carpet_id' => 'required_if:carpet_type,existing|exists:carpets,id',
            'custom_carpet_description' => 'required_if:carpet_type,custom|nullable|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        $quote->address_id = $validated['address_id'];
        $quote->measurement_id = $validated['measurement_id'];
        $quote->carpet_id = $request->input('carpet_id');
        $quote->notes = $request->input('notes');
        $quote->save();

        return redirect()->route('quotes.index')
            ->with('success', 'Quote updated successfully!');
    }

    public function destroy(Quote $quote)
    {
        if ($quote->user_id !== auth()->id()) {
            abort(403);
        }
        
        $quote->delete();
        
        return redirect()->route('quotes.index')
            ->with('success', 'Quote deleted successfully!');
    }
}