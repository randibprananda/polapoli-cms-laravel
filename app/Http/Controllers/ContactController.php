<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->middleware('permission:web-index|web-add|web-update|web-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:web-add', ['only' => ['store']]);
        $this->middleware('permission:web-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:web-delete', ['only' => ['destroy']]);
        $this->contactRepository = $contactRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->contactRepository->search(request('search'));
            return view('dashboard.settings.contact', compact('data'));
        } else {
            $data = $this->contactRepository->getPaginate(10);
            return view('dashboard.settings.contact', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->contactRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->contactRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit(Contact $businessOpCategory)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->contactRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->contactRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
