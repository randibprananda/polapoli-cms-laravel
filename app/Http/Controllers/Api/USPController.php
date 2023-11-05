<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\USPRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class USPController extends Controller
{
    private $uspRepository;

    public function __construct(
        USPRepository $uspRepository
    )
    {
        $this->uspRepository = $uspRepository;
    }
    public function index()
    {
        $data = $this->uspRepository->getActivesOnly();

        if ($data != null) {
            return response()->json([
                'message' => 'List of News',
                'data' => $data,

            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No News found',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id)
    {
        $data = $this->uspRepository->find($id);
        return response()->json([
            'message' => 'Detail of USP',
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
