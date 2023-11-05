<?php

namespace App\Repositories;

use App\Models\Layanan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LayananRepository
{

    private $model;

    public function __construct(Layanan $layanan)
    {
        $this->model = $layanan;
    }

    public function get()
    {
        $data = $this->model::get();
        return $data;
    }
    public function getActivesOnly()
    {
        $data = $this->model::where("status", "=", "1")->get();
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
                "title" => "required",
                "description" => "required",
                "picture" => "required",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception("salah di validator");
            }

            // Getting picture name after uploaded
            $pictureName = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request);

            try {
                $this->model::create([
                    "title" => $request->title,
                    "description" => $request->description,
                    "picture" => $pictureName,
                    "status" => $request->status,
                    "user_id" => Auth::user()->id
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
        $data = $this->model::where("title", "LIKE", "%$keyword%")
            ->paginate(10)->withQueryString();
        return $data;
    }

    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "required",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            // Update with picture
            if ($request->hasFile('picture')) {
                // Getting picture name after uploaded
                $pictureName = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request);
                $info = $this->model::find($id);
                $oldPictureName = $info->picture;
                $info->update([
                    "title" => $request->title,
                    "description" => $request->description,
                    "picture" => $pictureName,
                    "status" => $request->status,
                    "user_id" => Auth::user()->id
                ]);
                $this->deleteLocalPictureHelper($oldPictureName);
                return ["status" => "success", "message" => "Data updated succesfully."];
            }
            // update without picture
            else {
                $info = $this->model::find($id);
                $info->update([
                    "title" => $request->title,
                    "description" => $request->description,
                    "status" => $request->status,
                    "user_id" => Auth::user()->id
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
            $pictureName = $data->picture;
            $this->deleteLocalPictureHelper($pictureName);
            $data->delete();
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
