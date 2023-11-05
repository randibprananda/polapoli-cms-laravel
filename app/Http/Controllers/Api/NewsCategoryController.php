<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsCategoryController extends Controller
{
    public function getAll()
    {
        $data = NewsCategory::all();
        return response()->json([
            'message' => 'Detail of News',
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
