<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DivisionRepository;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    public function index()
    {
        $data = $this->divisionRepository->get();

        return response()->json([
            'message' => 'List of Division',
            'data' => $data,
        ], 200);
    }
}
