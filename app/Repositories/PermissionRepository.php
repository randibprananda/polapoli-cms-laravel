<?php

namespace App\Repositories;

use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function PHPUnit\Framework\isEmpty;

class PermissionRepository implements RepositoryInterface
{

    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function get()
    {
        $data = $this->permission::get();
        return $data;
    }
    public function all()
    {
        $data = $this->permission::all();
        return $data;
    }

    public function getPaginate($howMany)
    {
        $data = $this->permission::paginate($howMany);
        return $data;
    }

    public function find($id)
    {
        return $this->permission::find($id);
    }

    public function search($keyword)
    {
        // $data = $this->permission::where("title", "LIKE", "%$keyword%")
        // ->orWhere("content", "LIKE", "%$keyword%")
        // ->paginate(10)->withQueryString();
        // return $data;
    }

    public function store($data)
    {
        try {
            $count = 0;
            if ($data) {
                foreach ($data as $item) {
                    if ($this->permission::where("name", "=", "$item")->get()->isEmpty()) {
                        $count++;
                        $this->permission::create([
                            "name" => $item
                        ]);
                    }
                }
            }

            return ["status" => "success", "message" => "Data stored succesfully. $count item stored"];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
            // return false;
        }
    }
    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:permissions"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->permission::find($request->id);
            $data->update([
                "name" => $request->name,
            ]);
            return ["status" => "success", "message" => "Data updated succesfully." . $request->status];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }
    public function destroy($id)
    {
        try {
            $data = $this->permission::find($id);
            $data->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
