<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use App\Repositories\FaqRepository;
use App\Repositories\SocialMediaRepository;
use App\Repositories\WebRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BantuanController extends Controller
{
    private $faqRepository;

    public function __construct(
        FaqRepository $faqRepository,
        ContactRepository $contactRepository,
        SocialMediaRepository $socialMediaRepository,
        WebRepository $webRepository
    ) {
        $this->faqRepository = $faqRepository;
        $this->contactRepository = $contactRepository;
        $this->socialMediaRepository = $socialMediaRepository;
        $this->webRepository = $webRepository;
    }

    public function index()
    {

        $data = $this->faqRepository->getActivesOnly();
        $contact = $this->contactRepository->get();
        $socialMedia = $this->socialMediaRepository->get();
        $webRepository = $this->webRepository->get();
        if ($data != null) {
            return response()->json([
                'message' => 'List of Faq',
                'faq' => $data,
                'contact' => $contact,
                'social_media' => $socialMedia,
                'footer_desc' => $webRepository->first()->footer_desc,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No Faq found',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id)
    {
        $data = $this->faqRepository->find($id);
        return response()->json([
            'message' => 'Detail of Faq',
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
