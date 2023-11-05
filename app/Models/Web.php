<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    use HasFactory;
    protected $table = "web";
    protected $fillable = [
        "seo_keyword",
        "hero_title",
        "hero_subtitle",
        "hero_picture",

        "layanan_title",

        "solusi_title",
        "solusi_subtitle",

        "usp_title",
        "usp_subtitle",

        "testimonial_title",

        "about_detail_title",
        "about_detail_subtitle",
        "about_detail_picture",

        "pricing_title",
        "pricing_subtitle",

        "pricing_detail_title",
        "pricing_detail_subtitle",
        "pricing_detail_picture",

        "faq_title",

        "cta_title",
        "cta_subtitle",

        "footer_desc"
    ];
    public $timestamps = false;
}
