<?php

namespace App\Http\Controllers;

use App\Models\Carpet;
use Illuminate\Http\Request;

class CarpetController extends Controller
{
    public function index()
    {
        $carpets = Carpet::all();
        return view('carpets.index', compact('carpets'));
    }
}