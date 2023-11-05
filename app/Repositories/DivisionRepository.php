<?php

namespace App\Repositories;

use App\Models\Division;
use Exception;
use Illuminate\Support\Facades\Validator;

class DivisionRepository implements RepositoryInterface
{
    private $model;

    public function __construct(Division $division)
    {
        $this->model = $division;
    }

    public function get()
    {
        $data = $this->model::get();
        return $data;
    }

    public function getPaginate($howMany)
    {
        $data = $this->model::paginate($howMany);
        return $data;
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function search($keyword)
    {
        $data = $this->model::where("name", "LIKE", "%$keyword%");
    }

    public function findById($id)
    {
        try {

            return $this->model::find($id);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception("salah di validator");
            }

            $this->model::create([
                'name' => $request->name,
            ]);

            return ["status" => "success", "message" => "Data stored succesfully"];

        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }

    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $info = $this->model::find($id);
            $info->update([
                "name" => $request->name,
            ]);
            return ["status"=>"success", "message"=>"Data updated succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->model::find($id);
            $data->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
