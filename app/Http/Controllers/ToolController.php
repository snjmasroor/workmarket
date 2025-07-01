<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    public function getTool(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 if not provided

        $tools = Tool::select('id', 'name')->paginate($perPage);

        return response()->json($tools);
    }
}
