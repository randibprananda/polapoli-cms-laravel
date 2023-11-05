<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->middleware('permission:testimonial-index|testimonial-add|testimonial-update|testimonial-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:testimonial-add', ['only' => ['store']]);
        $this->middleware('permission:testimonial-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:testimonial-delete', ['only' => ['destroy']]);
        $this->testimonialRepository = $testimonialRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->testimonialRepository->search(request('search'));
            return view('dashboard.testimonial.index', compact('data'));
        } else {
            $data = $this->testimonialRepository->getPaginate(10);
            return view('dashboard.testimonial.index', compact('data'));
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->testimonialRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->testimonialRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit(Testimonial $testimonial)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->testimonialRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->testimonialRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
