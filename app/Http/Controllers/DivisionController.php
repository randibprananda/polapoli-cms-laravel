<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Repositories\DivisionRepository;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $divisionRepository;

    public function __construct(DivisionRepository $divisionRepository)
    {
        // $this->middleware('permission:division-index|division-add|division-update|division-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:division-add', ['only' => ['store']]);
        // $this->middleware('permission:division-update', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:division-delete', ['only' => ['destroy']]);
        $this->divisionRepository = $divisionRepository;
    }
    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->divisionRepository->search(request('search'));
            return view('dashboard.division.index', compact('data'));
        } else {
            $data = $this->divisionRepository->getPaginate(10);
            return view('dashboard.division.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isSuccess = $this->divisionRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->divisionRepository->find($id);
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $isSuccess = $this->divisionRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isSuccess = $this->divisionRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
