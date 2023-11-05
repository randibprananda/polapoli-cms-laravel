<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Repositories\PricingRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\AddonRepository;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    private $pricingRepository;
    private $divisionRepository;

    public function __construct(PricingRepository $pricingRepository, DivisionRepository $divisionRepository, AddonRepository $addonRepository)
    {
        $this->middleware('permission:pricing-index|pricing-add|pricing-update|pricing-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pricing-add', ['only' => ['store']]);
        $this->middleware('permission:pricing-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pricing-delete', ['only' => ['destroy']]);
        $this->pricingRepository = $pricingRepository;
        $this->divisionRepository = $divisionRepository;
        $this->addonRepository = $addonRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->pricingRepository->search(request('search'));
            return view('dashboard.pricing.index', compact('data'));
        } else {
            $data = $this->pricingRepository->getPaginate(10);
            return view('dashboard.pricing.index', compact('data'));
        }
    }

    public function getDivision(Request $request)
    {
        if($request->ajax()) {
            $data = $this->divisionRepository->get();
            return response()->json($data);
        }
    }

    public function getAddOn(Request $request)
    {
        if($request->ajax()) {
            $data = $this->addonRepository->get();
            return response()->json($data);
        }
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $isSuccess = $this->pricingRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->pricingRepository->find($id);
            $division = [];
            $select_add_on = [];

            $division = $data->division;

            $select_add_on = $data->select_add_on;

            $features = $data->features;

            return response()->json(["data" => $data, "division" => $division, "select_add_on" => $select_add_on, "features" => $features]);
        }
    }

    public function edit(Pricing $pricing)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->pricingRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->pricingRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
