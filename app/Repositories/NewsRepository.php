<?php

namespace App\Repositories;

use App\Models\News;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsRepository implements RepositoryInterface
{

    private $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }

    public function get()
    {
        $data = $this->model::get();
        return $data;
    }
    public function getByDESC()
    {
        $data = $this->model::orderBy("id", "DESC")->get();
        return $data;
    }
    public function getLastActive($howMany)
    {
        $data = $this->model::with('user')->where("status", "=", "1")->orderBy("id", "DESC")->limit($howMany)->get();
        return $data;
    }

    public function getByCategory($category_id)
    {
        $data = $this->model::with('user')->where('status', '=', 1)->where("category_id", "LIKE", "%$category_id%")->orderBy("id", "DESC")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function getPaginate($howMany)
    {
        $data = $this->model::with('user')->paginate($howMany);
        return $data;
    }

    public function getBySlug($slug)
    {
        $data = $this->model::where("slug", "LIKE", $slug)->orderBy("id", "DESC")->limit(1)->first();
        return $data;
    }

    public function getPaginateApi($howMany)
    {
        $data = $this->model::with('user')->where('status', '=', 1)->paginate($howMany)->withQueryString();
        return $data;
    }

    public function find($id)
    {
        return $this->model::with('user')->find($id);
    }
    public function store($request)
    {
        try {
            // Validate
            $validator = Validator::make($request->all(), [
                "picture" => "required",
                "title" => "required",
                "slug" => "required",
                "status" => "required|not_regex:/^Status$/i",
                "content" => "required",
                "description" => "nullable",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            // Getting picture name after uploaded
            $pictureName = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request);

            try {
                $this->model::create([
                    "title" => $request->title,
                    "slug" => $request->slug,
                    "content" => $request->content,
                    "keyword" => $request->keyword,
                    "category_id" => $this->parseCategoryIds($request->category_ids),
                    "picture" => $pictureName,
                    "status" => $request->status,
                    "user_id" => Auth::user()->id,
                    "description" => $request->description,
                ]);
                return ["status" => "success", "message" => "Data stored succesfully."];
            } catch (\Throwable $th) {
                return ["status" => "error", "message" => $th->getMessage()];
            }
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }

    public function search($keyword)
    {
        $data = $this->model::with('user')->where('status', '=', 1)->where("title", "LIKE", "%$keyword%")
            ->paginate(10)->withQueryString();
        return $data;
    }

    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "slug" => "required",
                "status" => "required|not_regex:/^Status$/i",
                "content" => "required",
                "description" => "nullable"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            // Update with picture
            if ($request->hasFile('picture')) {
                // Getting picture name after uploaded
                $pictureName = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request);
                $news = $this->model::find($id);
                $oldPictureName = $news->picture;
                $news->update([
                    "title" => $request->title,
                    "slug" => $request->slug,
                    "content" => $request->content,
                    "keyword" => $request->keyword,
                    "category_id" => $this->parseCategoryIds($request->category_ids),
                    "picture" => $pictureName,
                    "status" => $request->status,
                    "user_id" => Auth::user()->id,
                    "description" => $request->description,
                ]);
                $this->deleteLocalPictureHelper($oldPictureName);

                return ["status" => "success", "message" => "Data updated succesfully."];
            }
            // update without picture
            else {
                $news = $this->model::find($id);
                $news->update([
                    "title" => $request->title,
                    "slug" => $request->slug,
                    "content" => $request->content,
                    "keyword" => $request->keyword,
                    "category_id" => $this->parseCategoryIds($request->category_ids),
                    "status" => $request->status,
                    "user_id" => Auth::user()->id,
                    "description" => $request->description
                ]);

                return ["status" => "success", "message" => "Data updated succesfully."];
            }
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }
    public function destroy($id)
    {
        try {
            $data = $this->model::find($id);
            $data->delete();
            $oldPictureName = $data->picture;
            $this->deleteLocalPictureHelper($oldPictureName);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function parseKeyword($keywords)
    {
    }
    public function parseCategoryIds($category_ids)
    {
        if ($category_ids != null) {
            return join(",", $category_ids);
        }
        return "";
    }
    private function deleteLocalPictureHelper($fileName)
    {
        try {
            if ($fileName != "") {
                Storage::disk('local')->delete('public/image_uploaded/' . $fileName);
                return null;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function uploadPictureHelper($request)
    {
        try {
            $picture = $request->file('picture');
            $pictureName = $picture->hashName();
            $picture->storeAs("public/image_uploaded", $pictureName);
            return $pictureName;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
