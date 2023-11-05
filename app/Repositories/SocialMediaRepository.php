<?php

namespace App\Repositories;

use App\Models\SocialMedia;
use Exception;
use Illuminate\Support\Facades\Validator;

class SocialMediaRepository implements RepositoryInterface
{
    private $model;

    public function __construct(SocialMedia $model)
    {
        $this->model = $model;
    }


    public function get()
    {
        $data = $this->model::get();
        return $data;
    }
    public function getAssociative()
    {
        $data = $this->model::get();
        $returned_data = [];
        foreach ($data as $item) {
            if (strtolower($item->type) == "instagram") {
                $returned_data["instagram"] = [
                    "account_name" => $item->account_name,
                    "link" => $item->link
                ];
            } else if (strtolower($item->type) == "facebook") {
                $returned_data["facebook"] = [
                    "account_name" => $item->account_name,
                    "link" => $item->link
                ];
            } else if (strtolower($item->type) == "twitter") {
                $returned_data["twitter"] = [
                    "account_name" => $item->account_name,
                    "link" => $item->link
                ];
            } else if (strtolower($item->type) == "youtube") {
                $returned_data["youtube"] = [
                    "account_name" => $item->account_name,
                    "link" => $item->link
                ];
            } else if (strtolower($item->type) == "tiktok") {
                $returned_data["tiktok"] = [
                    "account_name" => $item->account_name,
                    "link" => $item->link
                ];
            }
        }
        return $returned_data;
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
            $previous_data = $this->getAssociative();

            if (isset($previous_data["instagram"])) {
                // update
                $data = $this->model::where("type", "LIKE", "instagram");
                $data->update([
                    "account_name"=>$request->instagram_account,
                    "link"=>$request->instagram_link
                ]);
                // return ["isset instagram "=>$data->first()];
            } else {
                // create new
                $this->model::create([
                    "type" => "instagram",
                    "account_name" => $request->instagram_account,
                    "link" => $request->instagram_link,
                ]);
            }
            if (isset($previous_data["facebook"])) {
                // update
                $data = $this->model::where("type", "LIKE", "facebook");
                $data->update([
                    "account_name"=>$request->facebook_account,
                    "link"=>$request->facebook_link
                ]);
            } else {
                // create new
                $this->model::create([
                    "type" =>  "facebook",
                    "account_name" => $request->facebook_account,
                    "link" => $request->facebook_link,
                ]);
            }
            if (isset($previous_data["twitter"])) {
                // update
                $data = $this->model::where("type", "LIKE", "twitter");
                $data->update([
                    "account_name"=>$request->twitter_account,
                    "link"=>$request->twitter_link
                ]);
            } else {
                // create new
                $this->model::create([
                    "type" =>  "twitter",
                    "account_name" => $request->twitter_account,
                    "link" => $request->twitter_link,
                ]);
            }
            if (isset($previous_data["youtube"])) {
                // update
                $data = $this->model::where("type", "LIKE", "youtube");
                $data->update([
                    "account_name"=>$request->youtube_account,
                    "link"=>$request->youtube_link
                ]);
            } else {
                // create new
                $this->model::create([
                    "type" =>  "youtube",
                    "account_name" => $request->youtube_account,
                    "link" => $request->youtube_link,
                ]);
            }
            if (isset($previous_data["tiktok"])) {
                $data = $this->model::where("type", "LIKE", "tiktok");
                $data->update([
                    "account_name"=>$request->tiktok_account,
                    "link"=>$request->tiktok_link
                ]);
                // update
            } else {
                // create new
                $this->model::create([
                    "type" =>  "tiktok",
                    "account_name" => $request->tiktok_account,
                    "link" => $request->tiktok_link,
                ]);
            }
            $new_data = $this->getAssociative();
            return ["status" => "success", "message" => "Data stored succesfully.", "data"=>$new_data];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }
    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "type" => "required",
                "account_name" => "required",
                "link" => "required"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->model::find($request->id);
            $data->update([
                "type" => $request->type,
                "account_name" => $request->account_name,
                "link" => $request->link,
            ]);
            return ["status" => "success", "message" => "Data stored succesfully."];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
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
