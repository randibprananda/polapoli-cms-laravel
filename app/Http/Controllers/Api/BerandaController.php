<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use App\Repositories\LayananRepository;
use App\Repositories\PricingRepository;
use App\Repositories\SocialMediaRepository;
use App\Repositories\SolusiRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\USPRepository;
use App\Repositories\WebRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BerandaController extends Controller
{
    private $solusiRepository;
    private $clientRepository;
    private $layananRepository;
    private $testimonialRepository;
    private $pricingRepository;
    private $contactRepository;
    private $socialMediaRepository;
    private $webRepository;
    private $uspRepository;

    public function __construct(
        SolusiRepository $solusiRepository,
        ClientRepository $clientRepository,
        LayananRepository $layananRepository,
        TestimonialRepository $testimonialRepository,
        PricingRepository $pricingRepository,
        ContactRepository $contactRepository,
        SocialMediaRepository $socialMediaRepository,
        WebRepository $webRepository,
        USPRepository $uspRepository
    ) {
        $this->solusiRepository = $solusiRepository;
        $this->clientRepository = $clientRepository;
        $this->layananRepository = $layananRepository;
        $this->testimonialRepository = $testimonialRepository;
        $this->pricingRepository = $pricingRepository;
        $this->contactRepository = $contactRepository;
        $this->socialMediaRepository = $socialMediaRepository;
        $this->webRepository = $webRepository;
        $this->uspRepository = $uspRepository;
    }
    function index()
    {
        $solusi = $this->solusiRepository->getActivesOnly();
        $client = $this->clientRepository->getActivesOnly();
        $layanan = $this->layananRepository->getActivesOnly();
        $testimonial = $this->testimonialRepository->getActivesOnly();
        $pricing = $this->pricingRepository->getActivesOnly();
        $contact = $this->contactRepository->get();
        $socialMedia = $this->socialMediaRepository->get();
        $webRepository = $this->webRepository->get();
        $uspRepository = $this->uspRepository->get();
        return response()->json([
            'message' => 'Beranda',
            'solusi' => $solusi,
            'client' => $client,
            'layanan' => $layanan,
            'testimonial' => $testimonial,
            'pricing' => $pricing,
            'contact' => $contact,
            'social_media' => $socialMedia,
            'usp' => $uspRepository,
            'hero_title' => $webRepository->first()->hero_title,
            'hero_subtitle' => $webRepository->first()->hero_subtitle,
            'hero_picture' => $webRepository->first()->hero_picture,
            'solusi_title' => $webRepository->first()->solusi_title,
            'solusi_subtitle' => $webRepository->first()->solusi_subtitle,
            'layanan_title' => $webRepository->first()->layanan_title,
            'testimonial_title' => $webRepository->first()->testimonial_title,
            'pricing_title' => $webRepository->first()->pricing_title,
            'pricing_subtitle' => $webRepository->first()->pricing_subtitle,
            'cta_title' => $webRepository->first()->cta_title,
            'cta_subtitle' => $webRepository->first()->cta_subtitle,
            'footer_desc' => $webRepository->first()->footer_desc,
        ], Response::HTTP_OK);
    }
}
