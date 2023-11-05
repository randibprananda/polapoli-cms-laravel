<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Repositories\AddonRepository;
use Illuminate\Http\Request;

class AddOnController extends Controller
{
    private $addon;

    public function __construct(AddonRepository $addon)
    {
        $this->middleware('permission:pricing-index|pricing-add|pricing-update|pricing-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pricing-add', ['only' => ['store']]);
        $this->middleware('permission:pricing-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pricing-delete', ['only' => ['destroy']]);
        $this->addon = $addon;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->addon->search(request('search'));
            return view('dashboard.pricing.add-on', compact('data'));
        } else {
            $data = $this->addon->getPaginate(10);
            return view('dashboard.pricing.add-on', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->addon->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        return $this->addon->find($id);
        if ($request->ajax()) {
            $data = $this->addon->find($id);
            return response()->json($data);
        }
    }

    public function edit(AddOn $addOn)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->addon->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->addon->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
