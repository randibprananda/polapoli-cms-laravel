<?php

namespace App\Repositories;

use App\Models\Faq;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FaqRepository implements RepositoryInterface
{
    private $model;

    public function __construct(faq $faq)
    {
        $this->model = $faq;
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

    public function getActivesOnly()
    {
        $data = $this->model::where("status","=", "1")->get();
        return $data;
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function search($keyword)
    {
        $data = $this->model::where("question", "LIKE", "%$keyword%")
        ->orWhere("answer", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function store($data)
    {
        try {
            $validator = Validator::make($data->all(), [
                "question" => "required",
                "answer" => "required",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $this->model::create([
                "question" => $data->question,
                "answer" => $data->answer,
                "status" => $data->status,
                "user_id" => Auth::user()->id
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
                "question" => "required",
                "answer" => "required",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->model::find($request->id);
            $data->update([
                "question" => $request->question,
                "answer" => $request->answer,
                "status" => $request->status,
                "user_id" => Auth::user()->id
            ]);
            return ["status"=>"success", "message"=>"Data updated succesfully.".$request->status];
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
