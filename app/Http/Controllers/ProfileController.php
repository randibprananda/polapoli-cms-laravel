<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('dashboard.profile.index');
    }
    public function uploadPhotoPic(Request $request, $id)
    {
        $isSuccess = $this->userRepository->uploadPhotoPic($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }
    public function deletePhotoPic($id)
    {
        $isSuccess = $this->userRepository->deletePhotoPic($id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }
}
