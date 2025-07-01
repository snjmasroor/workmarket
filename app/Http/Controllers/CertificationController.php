<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;

class CertificationController extends Controller
{
    public function getCertification(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 if not provided

        $certifications = Certification::select('id', 'name')->paginate($perPage);

        return response()->json($certifications);
    }
}
