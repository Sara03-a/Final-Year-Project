<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quote;
use App\Models\Address;
use App\Models\Measurement;
use Illuminate\Support\Facades\Auth;

/**
 * AdminController handles administrative functions and route management
 * This controller manages user authentication, CRUD operations for quotes,
 * addresses, measurements, and routes users to appropriate views
 * based on their user type (admin or regular user)
 */
class AdminController extends Controller
{
    /**
     * Handle the main routing logic after authentication
     * Directs users to appropriate views based on their usertype
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Check if user is authenticated
        if(Auth::id())
        {
            // Get the authenticated user's type
            $usertype = Auth()->user()->usertype; 

            // Route regular users to dashboard
            if($usertype=='user')
            {
                return redirect()->route('dashboard');
            }

            // Route administrators to admin panel
            else if($usertype=='admin')
            {
                // Get search query from request
                $search = request('search');
                
                // Fetch all users with their related data
                $query = User::with(['quotes', 'measurements', 'addresses'])
                    ->where('usertype', 'user');
                
                // Apply search filter if search parameter exists
                if ($search) {
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%')
                          ->orWhereHas('addresses', function($addressQuery) use ($search) {
                              $addressQuery->where('street_address', 'like', '%' . $search . '%')
                                          ->orWhere('city', 'like', '%' . $search . '%')
                                          ->orWhere('postal_code', 'like', '%' . $search . '%');
                          });
                    });
                }
                
                $users = $query->get();
                
                return view('admin.index', compact('users'));
            }

            // Redirect back if usertype is invalid
            else
            {
                return redirect()->back();
            }
        }
    }

    public function quotes()
    {
        $quotes = Quote::with('user')->latest()->paginate(10);
        return view('admin.quotes.index', compact('quotes'));
    }

    public function userQuotes(User $user)
    {
        $quotes = Quote::where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        return view('admin.quotes.user_quotes', compact('quotes', 'user'));
    }

    public function addresses()
    {
        $addresses = Address::with('user')->latest()->paginate(10);
        return view('admin.addresses.index', compact('addresses'));
    }

    public function measurements()
    {
        $measurements = Measurement::with(['user', 'address'])->latest()->paginate(10);
        return view('admin.measurements.index', compact('measurements'));
    }

    // Quote Management Methods
    public function createQuote()
    {
        return view('admin.quotes.create');
    }

    public function storeQuote(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        Quote::create($validatedData);
        return redirect()->route('admin.quotes')->with('success', 'Quote created successfully');
    }

    public function showQuote(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    public function editQuote(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    public function updateQuote(Request $request, Quote $quote)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $quote->update($validatedData);
        return redirect()->route('admin.quotes')->with('success', 'Quote updated successfully');
    }

    public function destroyQuote(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('admin.quotes')->with('success', 'Quote deleted successfully');
    }

    // Address Management Methods
    public function createAddress()
    {
        return view('admin.addresses.create');
    }

    public function storeAddress(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'street_address' => 'required|string',
            'address_line2' => 'nullable|string',
            'city' => 'required|string',
            'postal_code' => 'required|string'
        ]);

        Address::create($validatedData);
        return redirect()->route('admin.addresses')->with('success', 'Address created successfully');
    }

    public function showAddress(Address $address)
    {
        return view('admin.addresses.show', compact('address'));
    }

    public function editAddress(Address $address)
    {
        return view('admin.addresses.edit', compact('address'));
    }

    public function updateAddress(Request $request, Address $address)
    {
        $validatedData = $request->validate([
            'street_address' => 'required|string',
            'address_line2' => 'nullable|string',
            'city' => 'required|string',
            'postal_code' => 'required|string'
        ]);

        $address->update($validatedData);
        return redirect()->route('admin.addresses')->with('success', 'Address updated successfully');
    }

    public function destroyAddress(Address $address)
    {
        $address->delete();
        return redirect()->route('admin.addresses')->with('success', 'Address deleted successfully');
    }

    // Measurement Management Methods
    public function createMeasurement()
    {
        return view('admin.measurements.create');
    }

    public function storeMeasurement(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_id' => 'required|exists:addresses,id',
            'room_name' => 'required|string',
            'room_type' => 'required|string',
            'width' => 'required|numeric',
            'length' => 'required|numeric'
        ]);

        Measurement::create($validatedData);
        return redirect()->route('admin.measurements')->with('success', 'Measurement created successfully');
    }

    public function showMeasurement(Measurement $measurement)
    {
        return view('admin.measurements.show', compact('measurement'));
    }

    public function editMeasurement(Measurement $measurement)
    {
        return view('admin.measurements.edit', compact('measurement'));
    }

    public function updateMeasurement(Request $request, Measurement $measurement)
    {
        $validatedData = $request->validate([
            'room_name' => 'required|string',
            'room_type' => 'required|string',
            'width' => 'required|numeric',
            'length' => 'required|numeric'
        ]);

        $measurement->update($validatedData);
        return redirect()->route('admin.measurements')->with('success', 'Measurement updated successfully');
    }

    public function destroyMeasurement(Measurement $measurement)
    {
        $measurement->delete();
        return redirect()->route('admin.measurements')->with('success', 'Measurement deleted successfully');
    }

    /**
     * Display the home page for non-authenticated users
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home.index');
    }

}
