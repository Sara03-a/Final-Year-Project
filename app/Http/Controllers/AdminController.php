<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * AdminController handles administrative functions and route management
 * This controller manages user authentication and routes users to appropriate views
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
                // Fetch all users with their related data
                $users = User::with(['quotes', 'measurements', 'addresses'])
                    ->where('usertype', 'user')
                    ->get();
                
                return view('admin.index', compact('users'));
            }

            // Redirect back if usertype is invalid
            else
            {
                return redirect()->back();
            }
        }
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
