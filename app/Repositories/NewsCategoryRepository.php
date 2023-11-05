<?php

namespace App\Repositories;

use App\Models\NewsCategory;
use Exception;
use Illuminate\Support\Facades\Validator;

class NewsCategoryRepository implements RepositoryInterface
{
    private $model;

    public function __construct(NewsCategory $news)
    {
        $this->model = $news;
    }

    public function get()
    {
        $data = $this->model::get();
        return $data;
    }

    public function search($keyword)
    {
        $data = $this->model::where("title", "LIKE", "%$keyword%")
            ->paginate(10)->withQueryString();
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
    public function store($data)
    {
        try {
            $validator = Validator::make($data->all(), [
                "title" => "required"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $this->model::create([
                "title" => $data->title
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->model::find($request->id);
            $data->update([
                "title" => $request->title
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
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
