<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\Measurement;
use App\Models\Address;
use App\Models\User;

/**
 * DashboardController handles the main dashboard view for authenticated users
 * This controller is responsible for displaying user-specific data including quotes, measurements, and addresses
 */
class DashboardController extends Controller
{
    /**
     * Display the user's dashboard
     * 
     * @return View Returns the dashboard view with user's quotes, measurements, and addresses
     */
    public function index(): View
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        // Check if user is admin and redirect to admin dashboard
        if ($user->usertype === 'admin') {
            // For admin dashboard, get all users with their related data
            $users = User::with(['quotes', 'measurements', 'addresses'])->get();
            return view('admin.index', compact('users'));
        }
        
        // For regular users, retrieve their quotes with related data
        $quotes = $user->quotes()->with(['user', 'measurement'])->latest()->get();
        
        // Get user's measurements, ordered by latest first
        $measurements = $user->measurements()->latest()->get();
        
        // Get user's addresses, ordered by latest first
        $addresses = $user->addresses()->latest()->get();
        
        // Return the dashboard view with compact data array containing quotes, measurements, and addresses
        return view('dashboard', compact('quotes', 'measurements', 'addresses'));
    }
}