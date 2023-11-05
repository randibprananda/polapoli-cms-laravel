<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    private $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->middleware('permission:faq-index|faq-add|faq-update|faq-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:faq-add', ['only' => ['store']]);
        $this->middleware('permission:faq-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy']]);
        $this->faqRepository = $faqRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->faqRepository->search(request('search'));
            return view('dashboard.faq.index', compact('data'));
        } else {
            $data = $this->faqRepository->getPaginate(10);
            return view('dashboard.faq.index', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->faqRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->faqRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit(faq $faq)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->faqRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->faqRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
