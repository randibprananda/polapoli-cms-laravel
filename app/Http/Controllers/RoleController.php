<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('permission:role-index|role-add|role-update|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-add', ['only' => ['store', 'syncPermission']]);
        $this->middleware('permission:role-update', ['only' => ['edit', 'update', 'syncPermission']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy', 'syncPermission']]);
        $this->roleRepository = $roleRepository;    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search') ?? false) {
            $data = $this->roleRepository->search(request('search'));
            return view('dashboard.user.role', compact('data'));
        } else {
            $data = $this->roleRepository->getPaginate(10);
            return view('dashboard.user.role', compact('data'));
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
        $isSuccess = $this->roleRepository->store($request);
        if($isSuccess['status'] == "success"){
            return redirect()->back()->with(['status'=>$isSuccess["message"]]);
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
    public function show(Request $request,$id)
    {
        if($request->ajax()){ 
            $data = $this->roleRepository->find($id);
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
        $isSuccess = $this->roleRepository->update($request, $id);
        if($isSuccess['status'] == "success"){
            return redirect()->back()->with(['status'=>$isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }
    public function syncPermission(Request $request, $id)
    {
        $isSuccess = $this->roleRepository->update($request, $id);
        if($isSuccess['status'] == "success"){
            return redirect()->back()->with(['status'=>$isSuccess["message"]]);
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
        $isSuccess = $this->roleRepository->destroy($id);
        if($isSuccess){
            return redirect()->back()->with(['status'=>"Data deleted succesfully"]);
        } else {
            return redirect()->back()->withErrors("Failed to delete data.");
        }
    }
}
