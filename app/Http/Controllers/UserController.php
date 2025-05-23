<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function viewProfile(){
        // dd('asdasd');
        return view('user.profile');
    }
}
