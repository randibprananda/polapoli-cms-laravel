<?php

namespace App\Repositories;

use App\Models\Web;
use Exception;
use Illuminate\Support\Facades\Validator;

class WebRepository implements RepositoryInterface
{
    private $model;

    public function __construct(Web $model)
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
        $data = $this->model::orderBy("id", "DESC")->limit(1)->first();
        $returned_data = [];
        if($data) {
            $returned_data['seo_keyword'] = $data->seo_keyword;

            $returned_data['hero_title'] = $data->hero_title;
            $returned_data['hero_subtitle'] = $data->hero_subtitle;
            $returned_data['hero_picture'] = $data->hero_picture;

            $returned_data['layanan_title'] = $data->layanan_title;

            $returned_data['solusi_title'] = $data->solusi_title;
            $returned_data['solusi_subtitle'] = $data->solusi_subtitle;

            // $returned_data['usp_title'] = $data->usp_title;
            // $returned_data['usp_subtitle'] = $data->usp_subtitle;

            $returned_data['testimonial_title'] = $data->testimonial_title;

            $returned_data['about_detail_title'] = $data->about_detail_title;
            $returned_data['about_detail_subtitle'] = $data->about_detail_subtitle;
            $returned_data['about_detail_picture'] = $data->about_detail_picture;

            $returned_data['pricing_title'] = $data->pricing_title;
            $returned_data['pricing_subtitle'] = $data->pricing_subtitle;

            $returned_data['pricing_detail_title'] = $data->pricing_detail_title;
            $returned_data['pricing_detail_subtitle'] = $data->pricing_detail_subtitle;
            $returned_data['pricing_detail_picture'] = $data->pricing_detail_picture;

            $returned_data['faq_title'] = $data->faq_title;

            $returned_data['cta_title'] = $data->cta_title;
            $returned_data['cta_subtitle'] = $data->cta_subtitle;

            $returned_data['footer_desc'] = $data->footer_desc;
        }

        return $data;
    }

    public function getPaginate($howMany)
    {
        $data = $this->model::paginate($howMany);
        return $data;
    }
    public function first()
    {
        $data = $this->model::first();
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

            if($previous_data){
                // update it
                $data = $this->model::orderBy("id", "DESC")->first();

                $data->update([
                    "seo_keyword" => $request->seo_keyword,

                    "hero_title" => $request->hero_title,
                    "hero_subtitle" => $request->hero_subtitle,

                    "layanan_title" => $request->layanan_title,

                    "solusi_title" => $request->solusi_title,
                    "solusi_subtitle" => $request->solusi_subtitle,

                    // "usp_title" => $request->usp_title,
                    // "usp_subtitle" => $request->usp_subtitle,

                    "testimonial_title" => $request->testimonial_title,

                    "about_detail_title" => $request->about_detail_title,
                    "about_detail_subtitle" => $request->about_detail_subtitle,

                    "pricing_title" => $request->pricing_title,
                    "pricing_subtitle" => $request->pricing_subtitle,
                    "pricing_detail_title" => $request->pricing_detail_title,
                    "pricing_detail_subtitle" => $request->pricing_detail_subtitle,

                    "faq_title" => $request->faq_title,

                    "cta_title" => $request->cta_title,
                    "cta_subtitle" => $request->cta_subtitle,

                    "footer_desc" => $request->footer_desc,
                ]);

                if ($request->hasFile('hero_picture')) {
                    $pictureHero = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request->file("hero_picture"));
                    $data->update([
                        "hero_picture" => $pictureHero,
                    ]);
                }

                if ($request->hasFile('about_detail_picture')) {
                    $pictureAbout = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request->file("about_detail_picture"));
                    $data->update([
                        "about_detail_picture" => $pictureAbout,
                    ]);
                }

                if ($request->hasFile('pricing_detail_picture')) {
                    $picturePricing = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request->file("pricing_detail_picture"));
                    $data->update([
                        "pricing_detail_picture" => $picturePricing,
                    ]);
                }

            } else {
                // create new
                $this->model::create([
                    "seo_keyword" => $request->seo_keyword,

                    "hero_title" => $request->hero_title,
                    "hero_subtitle" => $request->hero_subtitle,
                    "hero_picture" => $pictureHero,

                    "layanan_title" => $request->layanan_title,

                    "solusi_title" => $request->solusi_title,
                    "solusi_subtitle" => $request->solusi_subtitle,

                    "testimonial_title" => $request->testimonial_title,

                    "about_detail_title" => $request->about_detail_title,
                    "about_detail_subtitle" => $request->about_detail_subtitle,
                    "about_detail_picture" => $pictureAbout,

                    "pricing_title" => $request->pricing_title,
                    "pricing_subtitle" => $request->pricing_subtitle,

                    "pricing_detail_title" => $request->pricing_detail_title,
                    "pricing_detail_subtitle" => $request->pricing_detail_subtitle,
                    "pricing_detail_picture" => $picturePricing,

                    "faq_title" => $request->faq_title,

                    "cta_title" => $request->cta_title,
                    "cta_subtitle" => $request->cta_subtitle,

                    "footer_desc" => $request->footer_desc,
                ]);

                if ($request->hasFile('hero_picture')) {
                    $pictureHero = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request->file("hero_picture"));
                    $this->model::create([
                        "hero_picture" => $pictureHero,
                    ]);
                }

                if ($request->hasFile('about_detail_picture')) {
                    $pictureAbout = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request->file("about_detail_picture"));
                    $this->model::create([
                        "about_detail_picture" => $pictureAbout,
                    ]);

                }

                if ($request->hasFile('pricing_detail_picture')) {
                    $picturePricing = env('APP_URL') . '/storage/image_uploaded/' . $this->uploadPictureHelper($request->file("pricing_detail_picture"));
                    $this->model::create([
                        "pricing_detail_picture" => $picturePricing,
                    ]);
                }
            }

            $new_data = $this->getAssociative();
            return ["status" => "success", "message" => "Data stored succesfully.", "data" => $new_data];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }
    public function update($request, $id)
    {
        try {

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

    private function deleteLocalPictureHelper($fileName)
    {
        try {
            if($fileName != ""){
                Storage::disk('local')->delete('public/image_uploaded/' . $fileName);
                return null;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function uploadPictureHelper($picture)
    {
        try {
            $pictureName = $picture->hashName();
            $picture->storeAs("public/image_uploaded", $pictureName);
            return $pictureName;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
