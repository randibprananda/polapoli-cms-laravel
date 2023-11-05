<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AddonRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAddonController extends Controller
{
    private $addonRepository;

    public function __construct(AddonRepository $addonRepository)
    {
        $this->addonRepository = $addonRepository;
    }

    public function index()
    {
        $data = $this->addonRepository->getActivesOnly();
        return response()->json([
            'message' => 'List of Add on',
            'pricing' => $data,
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $data = $this->addonRepository->find($id);
        return response()->json([
            'message' => 'Detail of Add on',
            'pricing' => $data,
        ], Response::HTTP_OK);
    }
}
