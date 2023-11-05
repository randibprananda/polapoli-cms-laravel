<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PricingRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiPricingController extends Controller
{
    public function __construct(PricingRepository $pricingRepository)
    {
        $this->pricingRepository = $pricingRepository;
    }
    function index()
    {
        $pricing = $this->pricingRepository->getActivesOnly();
        return response()->json([
            'message' => 'List of Pricing',
            'pricing' => $pricing,
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $data = $this->pricingRepository->find($id);
        return response()->json([
            'message' => 'Detail of Pricing',
            'pricing' => $data,
        ], Response::HTTP_OK);
    }
}
