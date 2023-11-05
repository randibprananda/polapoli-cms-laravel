<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->middleware('permission:client-index|client-add|client-update|client-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:client-add', ['only' => ['store']]);
        $this->middleware('permission:client-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client-delete', ['only' => ['destroy']]);
        $this->clientRepository = $clientRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->clientRepository->search(request('search'));
            return view('dashboard.client.index', compact('data'));
        } else {
            $data = $this->clientRepository->getPaginate(10);
            return view('dashboard.client.index', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->clientRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->clientRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit(Client $client)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->clientRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->clientRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
