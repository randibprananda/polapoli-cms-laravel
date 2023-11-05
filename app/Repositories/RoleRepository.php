<?php

namespace App\Repositories;
 
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RepositoryInterface
{

    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function get()
    {
        // $data = $this->role::select(['roles.*', DB::raw("COUNT(role_has_permissions.role_id) as row_count")])
        // ->leftjoin('role_has_permissions', 'roles.id', "=", "role_has_permissions.role_id")
        // ->groupBy('roles.id')
        // ->get();
        $data = $this->role::withCount(["permissions", 'users']) 
        ->get();
        return $data;
    }
    public function all()
    {
        $data = $this->role::all();
        return $data;
    }

    public function syncPermissions($role_id, $permission){
        try {
            $data= $this->role::find($role_id);
            // foreach($permission as $item){
            //     $data->givePermissionTo($item);
            // }
            $data->syncPermissions($permission);
            return ["status"=>"success", "message"=>"Role synced succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()]; 
        }
    }

    public function getPaginate($howMany)
    {
        $data = $this->role::withCount(["permissions", 'users'])->paginate($howMany);
        return $data;
    }

    public function find($id)
    {
        return $this->role::find($id);
    }
    public function findByName($name)
    {   
        try {
            
            return $this->role::findByName($name);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function search($keyword)
    {
        $data = $this->role::where("name", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function store($data)
    {
        try {
            $validator = Validator::make($data->all(), [
                "name" => "required|unique:roles"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $this->role::create([
                "name" => $data->name,
            ]);

            return ["status"=>"success", "message"=>"Data stored succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
            // return false;
        }
    }
    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:roles"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->role::find($request->id);
            $data->update([
                "name" => $request->name,
            ]);
            return ["status"=>"success", "message"=>"Data updated succesfully.".$request->status];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    public function destroy($id)
    {
        try {
            $data = $this->role::find($id);
            $data->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
