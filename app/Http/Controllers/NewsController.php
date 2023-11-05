<?php

namespace App\Http\Controllers;

use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsRepository;
    private $newsCategoryRepository;

    public function __construct(NewsRepository $newsRepository, NewsCategoryRepository $newsCategoryRepository)
    {
        $this->middleware('permission:news-index|news-add|news-update|news-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:news-add', ['only' => ['store']]);
        $this->middleware('permission:news-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
        $this->newsRepository = $newsRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
    }


    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->newsRepository->search(request('search'));
            return view('dashboard.news.index', compact('data'));
        } else {
            $data = $this->newsRepository->getPaginate(10);
            return view('dashboard.news.index', compact('data'));
        }
    }

    public function create()
    {
        $news_categories = $this->newsCategoryRepository->get();
        return view('dashboard.news.manage', compact('news_categories'));
    }

    public function store(Request $request)
    {
        $isSuccess = $this->newsRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->route("dashboard.news.index")->with(['status' => $isSuccess["message"]]);
        } else {
            return back()->withErrors($isSuccess["message"])->withInput($request->input());
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->newsRepository->find($id);
            return response()->json($data);
        }
    }

    public function edit($id)
    {
        $data = $this->newsRepository->find($id);
        $news_categories = $this->newsCategoryRepository->get();
        return view('dashboard.news.manage', compact('data', 'news_categories'));
        // dd($newsOpCategory);
    }


    public function update(Request $request, $id)
    {
        // dd($request->category_ids);
        $isSuccess = $this->newsRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors("Failed to update data. " . $isSuccess['message'])->withInput($request->input());
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->newsRepository->destroy($id);
        if ($isSuccess) {
            return redirect()->back()->with(['status' => "Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
