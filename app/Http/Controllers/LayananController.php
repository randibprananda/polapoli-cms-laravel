<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Repositories\LayananRepository;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    private $layananRepository;

    public function __construct(LayananRepository $layananRepository)
    {
        $this->middleware('permission:layanan-index|layanan-add|layanan-update|layanan-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:layanan-add', ['only' => ['store']]);
        $this->middleware('permission:layanan-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:layanan-delete', ['only' => ['destroy']]);
        $this->layananRepository = $layananRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->layananRepository->search(request('search'));
            return view('dashboard.layanan.index', compact('data'));
        } else {
            $data = $this->layananRepository->getPaginate(10);
            return view('dashboard.layanan.index', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->layananRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->layananRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit(Layanan $layanan)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->layananRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->layananRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
