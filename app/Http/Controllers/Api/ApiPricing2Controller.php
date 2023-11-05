<?php

namespace App\Http\Controllers\Api;

use App\Models\Pricing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiPricing2Controller extends Controller
{
    public function index(Request $request)
    {
        if($request->division_id)
        {
            $data = Pricing::with([
                'select_add_on.add_on',
                'features',
            ])
                ->where('division_id', $request->division_id)
                ->where('status', 1)
                ->get();
        }
        else
        {
            $data = [];
        }

        return response()->json([
            'message' => 'List of Pricing',
            'data' => $data,
        ]);
    }

    public function getAllPricing()
    {
        $data = Pricing::with([
            'select_add_on.add_on',
            'features'
        ])
        ->where('status', 1)
        ->get();

        return response()->json([
            'message' => 'List All Pricing',
            'data' => $data,
        ]);
    }
}
