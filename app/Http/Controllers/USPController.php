<?php

namespace App\Http\Controllers;

use App\Repositories\USPRepository;
use Illuminate\Http\Request;

class USPController extends Controller
{
    private $uspRepository;

    public function __construct(USPRepository $uspRepository)
    {
        $this->middleware('permission:usp-index|usp-add|usp-update|usp-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:usp-add', ['only' => ['store']]);
        $this->middleware('permission:usp-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:usp-delete', ['only' => ['destroy']]);
        $this->uspRepository = $uspRepository;
    }

    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->uspRepository->search(request('search'));
            return view('dashboard.usp.index', compact('data'));
        } else {
            $data = $this->uspRepository->getPaginate(10);
            return view('dashboard.usp.index', compact('data'));
        }
    }

    public function store(Request $request)
    {
        $isSuccess = $this->uspRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->uspRepository->find($id);
            return response()->json($data);
        }
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->uspRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->uspRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
