<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;

class CertificationController extends Controller
{
    function getCertification() {
        $certications = Certification::select('id', 'name')->get();
       return response()->json($certications);
    }
}
