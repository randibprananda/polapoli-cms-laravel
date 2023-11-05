<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use App\Repositories\PricingRepository;
use App\Repositories\SocialMediaRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\WebRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HargaController extends Controller
{
    public function __construct(
        PricingRepository $pricingRepository,
        TestimonialRepository $testimonialRepository,
        ContactRepository $contactRepository,
        SocialMediaRepository $socialMediaRepository,
        WebRepository $webRepository
    ) {
        $this->pricingRepository = $pricingRepository;
        $this->testimonialRepository = $testimonialRepository;
        $this->contactRepository = $contactRepository;
        $this->socialMediaRepository = $socialMediaRepository;
        $this->webRepository = $webRepository;
    }
    function index()
    {
        $testimonial = $this->testimonialRepository->getActivesOnly();
        $pricing = $this->pricingRepository->getActivesOnly();
        $contact = $this->contactRepository->get();
        $socialMedia = $this->socialMediaRepository->get();
        $webRepository = $this->webRepository->get();
        return response()->json([
            'message' => 'Harga',
            'testimonial' => $testimonial,
            'pricing' => $pricing,
            'contact' => $contact,
            'social_media' => $socialMedia,
            'pricing_detail_title' => $webRepository->first()->pricing_detail_title,
            'pricing_detail_subtitle' => $webRepository->first()->pricing_detail_subtitle,
            'pricing_detail_picture' => $webRepository->first()->pricing_detail_picture,
            'pricing_title' => $webRepository->first()->pricing_title,
            'pricing_subtitle' => $webRepository->first()->pricing_subtitle,
            'testimonial_title' => $webRepository->first()->testimonial_title,
            'cta_title' => $webRepository->first()->cta_title,
            'cta_subtitle' => $webRepository->first()->cta_subtitle,
            'footer_desc' => $webRepository->first()->footer_desc,
        ], Response::HTTP_OK);
    }
}
