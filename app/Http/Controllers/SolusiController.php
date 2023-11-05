<?php

namespace App\Http\Controllers;

use App\Models\Solusi;
use App\Repositories\SolusiRepository;
use Illuminate\Http\Request;

class SolusiController extends Controller
{
    private $solusiRepository;

    public function __construct(SolusiRepository $solusiRepository)
    {
        $this->middleware('permission:solusi-index|solusi-add|solusi-update|solusi-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:solusi-add', ['only' => ['store']]);
        $this->middleware('permission:solusi-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:solusi-delete', ['only' => ['destroy']]);
        $this->solusiRepository = $solusiRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->solusiRepository->search(request('search'));
            return view('dashboard.solusi.index', compact('data'));
        } else {
            $data = $this->solusiRepository->getPaginate(10);
            return view('dashboard.solusi.index', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->solusiRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->solusiRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit(Solusi $solusi)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->solusiRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->solusiRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
