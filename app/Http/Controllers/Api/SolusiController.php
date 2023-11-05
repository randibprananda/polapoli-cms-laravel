<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;
use App\Repositories\ContactRepository;
use App\Repositories\LayananRepository;
use App\Repositories\SocialMediaRepository;
use App\Repositories\SolusiRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\WebRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SolusiController extends Controller
{
    public function __construct(
        SolusiRepository $solusiRepository,
        ClientRepository $clientRepository,
        LayananRepository $layananRepository,
        TestimonialRepository $testimonialRepository,
        ContactRepository $contactRepository,
        SocialMediaRepository $socialMediaRepository,
        WebRepository $webRepository
    ) {
        $this->solusiRepository = $solusiRepository;
        $this->clientRepository = $clientRepository;
        $this->layananRepository = $layananRepository;
        $this->testimonialRepository = $testimonialRepository;
        $this->contactRepository = $contactRepository;
        $this->socialMediaRepository = $socialMediaRepository;
        $this->webRepository = $webRepository;
    }
    function index()
    {
        $solusi = $this->solusiRepository->getActivesOnly();
        $client = $this->clientRepository->getActivesOnly();
        $layanan = $this->layananRepository->getActivesOnly();
        $testimonial = $this->testimonialRepository->getActivesOnly();
        $contact = $this->contactRepository->get();
        $socialMedia = $this->socialMediaRepository->get();
        $webRepository = $this->webRepository->get();
        return response()->json([
            'message' => 'Solusi',
            'solusi' => $solusi,
            'client' => $client,
            'layanan' => $layanan,
            'testimonial' => $testimonial,
            'contact' => $contact,
            'social_media' => $socialMedia,
            'solusi_title' => $webRepository->first()->solusi_title,
            'solusi_subtitle' => $webRepository->first()->solusi_subtitle,
            'layanan_title' => $webRepository->first()->layanan_title,
            'testimonial_title' => $webRepository->first()->testimonial_title,
            'cta_title' => $webRepository->first()->cta_title,
            'cta_subtitle' => $webRepository->first()->cta_subtitle,
            'footer_desc' => $webRepository->first()->footer_desc,
        ], Response::HTTP_OK);
    }
}
