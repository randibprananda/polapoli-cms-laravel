<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use App\Repositories\NewsCategoryRepository;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{

    private $newsCategoryRepository;

    public function __construct(NewsCategoryRepository $nCatagoryRepository)
    {
        $this->middleware('permission:news-index|news-add|news-edit|news-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:news-add', ['only' => ['store']]);
        $this->middleware('permission:news-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
        $this->newsCategoryRepository = $nCatagoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->newsCategoryRepository->search(request('search'));
        } else {
            $data = $this->newsCategoryRepository->getPaginate(10);
        }
        return view('dashboard.news.category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isSuccess = $this->newsCategoryRepository->store($request);
        if($isSuccess){
            return redirect()->back()->with(['status'=>"Data stored succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to store data.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->ajax()){
            $data = $this->newsCategoryRepository->find($id);
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsCategory $newsCategory)
    {
        dd($newsCategory);
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->newsCategoryRepository->update($request, $id);
        if($isSuccess){
            return redirect()->back()->with(['status'=>"Data updated succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to update data.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isSuccess = $this->newsCategoryRepository->destroy($id);
        if($isSuccess){
            return redirect()->back()->with(['status'=>"Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
