<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use App\Repositories\ContactRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SocialMediaRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtikelController extends Controller
{
    private $newsRepository;
    private $contactRepository;
    private $socialMediaRepository;

    public function __construct(
        NewsRepository $newsRepository,
        ContactRepository $contactRepository,
        SocialMediaRepository $socialMediaRepository
    )
    {
        $this->newsRepository = $newsRepository;
        $this->contactRepository = $contactRepository;
        $this->socialMediaRepository = $socialMediaRepository;
    }

    public function index(Request $request)
    {
        $contact = $this->contactRepository->get();
        $socialMedia = $this->socialMediaRepository->get();
        if (request('search') ?? false) {
            $data = $this->newsRepository->search(request('search'));
        } elseif (request('category_id') ?? false ) {
            $data = $this->newsRepository->getByCategory(request('category_id'));
        } else {
            $data = $this->newsRepository->getPaginateApi(10);
        }

        if ($data != null) {
            return response()->json([
                'message' => 'List of News',
                'data' => $data,
                'contact' => $contact,
                'social_media' => $socialMedia,

            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No News found',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show($slug)
    {
        $contact = $this->contactRepository->get();
        $socialMedia = $this->socialMediaRepository->get();
        $data = $this->newsRepository->getBySlug($slug);
        $rekomendasi = $this->newsRepository->getPaginateApi(5);
        return response()->json([
            'message' => 'Detail of News',
            'data' => $data,
            'rekomendasi' => $rekomendasi,
            'contact' => $contact,
            'social_media' => $socialMedia,
        ], Response::HTTP_OK);
    }

    public function outhor($id)
    {
        $data = User::with('news')->find($id);
        return response()->json([
            'message' => 'Outhor of news',
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
