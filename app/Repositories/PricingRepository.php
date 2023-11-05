<?php

namespace App\Repositories;

use App\Models\Pricing;
use App\Models\SelectAddOn;
use App\Models\Feature;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PricingRepository {

    private $model;

    public function __construct(Pricing $pricing)
    {
        $this->model = $pricing;
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
        $data = $this->model::with('division', 'select_add_on')->paginate($howMany);
        return $data;
    }

    public function find($id)
    {
        return $this->model::with(['division', 'select_add_on', 'features'])->find($id);
    }
    public function store($request)
    {
        try {
            // Validate
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "price" => "required|numeric",
                "duration" => "required|numeric",
                // "feature" => "required",
                "quantity" => "required|numeric",
                "status" => "required|not_regex:/^Status$/i",
                "package_type" => "required",
                "division_id" => "required",
                "add_on.*" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception("salah di validator");
            }

            try {
                $pricing = $this->model::create([
                    "title" => $request->title,
                    "price" => $request->price,
                    "duration" => $request->duration,
                    "status" => $request->status,
                    "quantity" => $request->quantity,
                    "package_type" => $request->package_type,
                    "division_id" => $request->division_id,
                    "user_id" => Auth::user()->id
                ]);

                foreach($request->feature as $key => $feature)
                {
                    Feature::create([
                        "pricing_id" => $pricing->id,
                        'title' => $feature,
                        'status' => $request->status_feature[$key],
                    ]);
                }

                foreach($request->add_on as $addon){
                    SelectAddOn::create([
                        "pricing_id" => $pricing->id,
                        "add_on_id" => $addon
                    ]);
                }

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
        $data = $this->model::with('division')->where("title", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "price" => "required|numeric",
                "duration" => "required|numeric",
                // "feature" => "required",
                "quantity" => "required|numeric",
                "status" => "required|not_regex:/^Status$/i",
                "package_type" => "required",
                "division_id" => "required",
                "add_on.*" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $info = $this->model::find($id);
            $info->update([
                "title" => $request->title,
                "price" => $request->price,
                "duration" => $request->duration,
                // "feature" => $request->feature,
                "status" => $request->status,
                "quantity" => $request->quantity,
                "package_type" => $request->package_type,
                "division_id" => $request->division_id,
                "user_id" => Auth::user()->id
            ]);

            $existingFeatureIds = $request->input('feature_id', []);
            $existingFeatureTitle = $request->input('feature', []);
            $existingStatusFeature = $request->input('status_feature', []);
            $existingFeatures = Feature::where('pricing_id', $id)->get();

            foreach ($existingFeatures as $existingFeature) {
                $featureIndex = array_search($existingFeature->id, $existingFeatureIds);
                if ($featureIndex !== false) {
                    // Update existing feature
                    $existingFeature->title = $existingFeatureTitle[$featureIndex];
                    $existingFeature->status = $existingStatusFeature[$featureIndex];
                    $existingFeature->save();
                    unset($existingFeatureIds[$featureIndex]);
                    unset($existingFeatureTitle[$featureIndex]);
                    unset($existingStatusFeature[$featureIndex]);
                } else {
                    // Remove feature if not found in the hidden input fields
                    $existingFeature->delete();
                }
            }

            if(!empty($existingFeatureTitle)){
                foreach ($existingFeatureTitle as $index => $title) {
                    Feature::create([
                        'pricing_id' => $id,
                        'title' => $title,
                        'status' => $existingStatusFeature[$index],
                    ]);
                }
            }

            $selectAddOn = $request->input('add_on', []);
            $existingSelectAddon = SelectAddOn::where('pricing_id', $id)->get();

            foreach($existingSelectAddon as $select){

                $addonIndex = array_search($select->id, $selectAddOn);
                if($addonIndex !== false)
                {
                    unset($selectAddOn[$addonIndex]);
                }
                else
                {
                    $select->delete();
                }
            }

            if(!empty($selectAddOn)){

                foreach ($selectAddOn as $index => $addon) {
                    SelectAddOn::create([
                        'pricing_id' => $id,
                        'add_on_id' => $addon,
                    ]);
                }
            }

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
            Feature::where("pricing_id", $id)->delete();
            SelectAddOn::where("pricing_id", $id)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
