<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    public function index()
    {
        $measurements = Auth::user()->measurements;
        return view('measurements.index', compact('measurements'));
    }

    public function create()
    {
        $addresses = Auth::user()->addresses;
        return view('measurements.create', compact('addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'length' => 'required|numeric|min:0',
            'width' => 'required|numeric|min:0',
            'address_id' => 'required|exists:addresses,id',
        ]);

        $measurement = new Measurement([
            'room_name' => $validated['room_name'],
            'length' => $validated['length'],
            'width' => $validated['width'],
            'address_id' => $validated['address_id'],
            'user_id' => Auth::id()
        ]);
        $measurement->save();

        return redirect()->route('measurements.index')
            ->with('success', 'Measurement created successfully.');
    }

    public function edit(Measurement $measurement)
    {
        if (auth()->id() !== $measurement->user_id) {
            abort(403, 'Unauthorised action.');
        }
        return view('measurements.edit', compact('measurement'));
    }

    public function update(Request $request, Measurement $measurement)
    {
        if (auth()->id() !== $measurement->user_id) {
            abort(403, 'Unauthorised action.');
        }

        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'length' => 'required|numeric|min:0',
            'width' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
        ]);

        $measurement->update($validated);

        return redirect()->route('measurements.index')
            ->with('success', 'Measurement updated successfully.');
    }

    public function destroy(Measurement $measurement)
    {
        if (auth()->id() !== $measurement->user_id) {
            abort(403, 'Unauthorised action.');
        }
        $measurement->delete();

        return redirect()->route('measurements.index')
            ->with('success', 'Measurement deleted successfully.');
    }
}