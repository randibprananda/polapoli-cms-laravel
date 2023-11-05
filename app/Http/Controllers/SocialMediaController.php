<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Repositories\SocialMediaRepository;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    private $socialMediaRepository;

    public function __construct(SocialMediaRepository $socialMediaRepository)
    {
        $this->middleware('permission:web-index|web-add|web-update|web-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:web-add', ['only' => ['store']]);
        $this->middleware('permission:web-update', ['only' => ['edit', 'update']]);
        $this->socialMediaRepository = $socialMediaRepository;    
    }


    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $this->socialMediaRepository->getAssociative();
            return response()->json($data);
        }
        $data = $this->socialMediaRepository->getAssociative();
        return view('dashboard.settings.social', compact('data'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $isSuccess = $this->socialMediaRepository->store($request);
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

    public function edit(SocialMedia $businessOpCategory)
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
