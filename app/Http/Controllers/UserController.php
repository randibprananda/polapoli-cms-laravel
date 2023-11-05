<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('permission:user-index|user-add|user-update|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-add', ['only' => ['store']]);
        $this->middleware('permission:user-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


    public function index()
    {

        if (request('search') ?? false) {
            $data = $this->userRepository->search(request('search'));
            return view('dashboard.user.index', compact('data'));
        } else {
            $data = $this->userRepository->getPaginate(10);
            return view('dashboard.user.index', compact('data'));
        }
    }
    public function getRole(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->roleRepository->get();
            return response()->json($data);
        }
    }

    public function search(Request $request)
    {
        //
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $isSuccess = $this->userRepository->store($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = $this->userRepository->find($id);
            $role = [];
            if(count($user->getRoleNames()) > 0){
                $role = $this->roleRepository->findByName($user->getRoleNames()[0]);
            }
            return response()->json(["user"=>$user, "role"=>$role]);
        }
    }

    public function edit(User $businessOpCategory)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $isSuccess = $this->userRepository->update($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }
    public function updatePassword(Request $request, $id)
    {
        $isSuccess = $this->userRepository->updatePassword($request, $id);
        if ($isSuccess['status'] == "success") {
            Auth::logout();
            return redirect()->route('login')->with(['status' => $isSuccess["message"]." Re-enter your new password."]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }
    public function updateProfile(Request $request, $id)
    {
        $isSuccess = $this->userRepository->update_profile($request, $id);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    public function destroy($id)
    {
        $isSuccess = $this->userRepository->destroy($id);
        if ($isSuccess == 'success') {
            return redirect()->back()->with(['status' => $isSuccess["message"]]);
        } else {
            return redirect()->back()->withErrors($isSuccess["message"]);
        }
    }

    // public function sendEmail(Request $request){
    //     $request->validate(['email'=>"required|email"]);
    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );
    //     return $status === Password::RESET_LINK_SENT
    //         ? back()->with(['status'=> __($status)])
    //         : back()->withErrors(["email"=> __($status)]);
    // }

    // public function resetPassword($token){
    //     // need to change to password without s
    //     return view('auth.passwords.reset', ['token'=>$token]);
    // }

    // public function updatePassword(Request $request){
    //     $request->validate([
    //         'token'=> 'required',
    //         'email'=> 'required|email',
    //         'password'=> 'required|min:8|confirmed'
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password){
    //             $user->forceFill([
    //                 'password'=>Hash::make($password)
    //             ])->setRememberToken(Str::random(60));
    //             $user->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     return $status === Password::PASSWORD_RESET
    //         ? redirect()->route("login")->with("status", __($status))
    //         : back()->withErrors(["email"=> __($status)]);

    // }

}
