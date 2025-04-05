<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        $address = new Address($validated);
        $address->user_id = Auth::id();
        $address->save();

        return redirect()->route('addresses.index')
            ->with('success', 'Address created successfully.');
    }

    public function edit(Address $address)
    {
        if (auth()->id() !== $address->user_id) {
            abort(403, 'Unauthorised action.');
        }
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        if (auth()->id() !== $address->user_id) {
            abort(403, 'Unauthorised action.');
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        $address->update($validated);

        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        if (auth()->id() !== $address->user_id) {
            abort(403, 'Unauthorised action.');
        }
        $address->delete();

        return redirect()->route('addresses.index')
            ->with('success', 'Address deleted successfully.');
    }
}