<?php

namespace App\Repositories;

use App\Models\AddOn;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AddonRepository {

    private $model;

    public function __construct(AddOn $addOn)
    {
        $this->model = $addOn;
    }

    public function get()
    {
        $data = $this->model::get();
        return $data;
    }
    public function getActivesOnly()
    {
        $data = $this->model::where("status","=", "1")->get();
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
    public function store($request)
    {
        try {
            // Validate
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'price' => 'required',
                'periode' => 'required',
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception("salah di validator");
            }

            try {
                $this->model::create([
                    "title" => $request->title,
                    "slug" => $request->title,
                    "price" => $request->price,
                    "periode" => $request->periode,
                    "description" => $request->description,
                    "status" => $request->status,
                    "user_id" => Auth::user()->id
                ]);
                return ["status"=>"success", "message"=>"Data stored succesfully."];

            } catch (\Throwable $th) {
                return ["status" => "error", "message" => $th->getMessage()];
            }
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }

    public function search($keyword)
    {
        $data = $this->model::where("title", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'price' => 'required',
                'periode' => 'required',
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $info = $this->model::find($id);
            $info->update([
                "price" => $request->price,
                "periode" => $request->periode,
                "description" => $request->description,
                "user_id" => Auth::user()->id,
                "status" => $request->status,
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
