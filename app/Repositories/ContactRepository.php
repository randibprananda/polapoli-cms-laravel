<?php

namespace App\Repositories;
 
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\Validator;

class ContactRepository implements RepositoryInterface
{
    private $model;

    public function __construct(Contact $news)
    {
        $this->model = $news;
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
        $data = $this->model::where("title", "LIKE", "%$keyword%")
        ->orWhere("content", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function store($data)
    {
        try {
            $validator = Validator::make($data->all(), [
                "title" => "required",
                "content" => "required",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $this->model::create([
                "title" => $data->title,
                "content" => $data->content,
                "status" => $data->status
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
                "title" => "required",
                "content" => "required",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->model::find($request->id);
            $data->update([
                "title" => $request->title,
                "content" => $request->content,
                "status" => $request->status
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
