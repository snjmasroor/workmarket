<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;

class IndusrtyController extends Controller
{
    
    public function index() {
        $industries = Industry::all();
        // dd($industries);
        
        return view('admin.show-industries', compact('industries'));
    }
    
}
