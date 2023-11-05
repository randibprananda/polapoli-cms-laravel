<?php

namespace App\Http\Controllers;

use App\Models\Web;
use App\Repositories\WebRepository;
use Illuminate\Http\Request;

class WebController extends Controller
{
    private $webRepository;

    public function __construct(WebRepository $webRepository)
    {
        $this->middleware('permission:web-index|web-add|web-update', ['only' => ['index', 'show']]);
        $this->middleware('permission:web-add', ['only' => ['store']]);
        $this->middleware('permission:web-update', ['only' => ['edit', 'update']]);
        $this->webRepository = $webRepository;    
    }


    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->webRepository->getAssociative();
            return response()->json($data);
        }
        $data = $this->webRepository->getAssociative();
        return view('dashboard.settings.web', compact('data'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $isSuccess = $this->webRepository->store($request);
        if($request->ajax()){
            if($isSuccess['status'] == "success"){ 
                return response()->json($isSuccess['data'], 200);
            } else {
                return response()->json($isSuccess['message'], 404);
            }
        }
        if($isSuccess['status'] == "success"){
            return redirect()->back()->with(['status'=>$isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        // 
    }

    public function edit(Web $web)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        // 
    }

    public function destroy($id)
    {
        // 
    }
}
