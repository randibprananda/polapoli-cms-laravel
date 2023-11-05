<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    private $permissionRepository;
    private $roleRepository;

    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->middleware('permission:role-index|role-add|role-update|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-add', ['only' => ['store']]);
        $this->middleware('permission:role-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $role_for_json = $this->roleRepository->find(request('role'));
            $permissions = [];
            if($role_for_json){
                foreach($role_for_json->permissions as $permission){
                    $permissions[] = $permission->name;
                }
            }
            return response()->json($permissions);
        }
        
        $data = $this->permissionRepository->get();
        $role = $this->roleRepository->find(request('role'));
        return view("dashboard.user.permission", compact('data', 'role'));
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
        $isPermissionSuccess = $this->permissionRepository->store($request->permission);
        $isRoleSuccess = $this->roleRepository->syncPermissions($request->role_id, $request->permission);

        if ($isPermissionSuccess['status'] == "success" && $isRoleSuccess['status'] == "success") {
            return response()->json($isRoleSuccess['message'], 200);
        } else {
            return response()->json([$isPermissionSuccess['message'], $isRoleSuccess['message']], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
