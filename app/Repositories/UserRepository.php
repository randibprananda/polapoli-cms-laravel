<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserRepository implements RepositoryInterface
{
    private $model;
    private $role;

    public function __construct(User $model, Role $role)
    {
        $this->model = $model;
        $this->role = $role;
    }


    public function get()
    {
        $data = $this->model::get();
        return $data;
    }

    public function getPaginate($howMany)
    {
        $data = $this->model::paginate($howMany);
        return $data;
    }

    public function find($id)
    {
        return $this->model::find($id);
    }
    public function search($keyword)
    {
        $data = $this->model::where("name", "LIKE", "%$keyword%")
        ->orWhere("email", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }
    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email|unique:users",
                "phone" => "required|numeric",
                "picture" => "required|image|max:2048",
                "role" => "required|not_regex:/^Role$/i",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

             // Getting picture name after uploaded
            $pictureName = env('APP_URL') . '/storage/image_uploaded/' .  $this->uploadPictureHelper($request);

            $user = $this->model::create([
                "name" => $request->name,
                "display_name" => $request->display_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "description" => $request->description,
                "picture" => $pictureName,
                "address" => $request->address,
                "departement" => $request->departement,
                "password" => $request->password == "" ? Hash::make("12345678") : $request->password,
                "status" => $request->status,
            ]);

            $user = $user->fresh();
            $role = $this->role::find($request->role);
            $user->syncRoles([$role->name]);

            return ["status"=>"success", "message"=>"Data stored succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    public function update($request, $id)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                'email' => [
                    'required', 'email', 'string', 'max:255',
                    Rule::unique('users', 'email')->where(function ($query) {
                        $query->where('id', '<>', request()->id);
                    }),
                ],
                "phone" => "required|numeric",
                "description" => "required",
                "role" => "required|not_regex:/^Role$/i",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            if ($request->hasFile('picture')) {
               $pictureName = env('APP_URL') . '/storage/image_uploaded/' .  $this->uploadPictureHelper($request);
               $data = $this->model::find($request->id);
               $oldPictureName = $data->picture;
                $data->update([
                    "name" => $request->name,
                    "display_name" => $request->display_name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "description" => $request->description,
                    "picture" => $pictureName,
                    "address" => $request->address,
                    "departement" => $request->departement,
                    "status" => $request->status,
                ]);

                $user = $this->model::find($request->id);
                $role = $this->role::find($request->role);
                $user->syncRoles([$role->name]);
                $this->deleteLocalPictureHelper($oldPictureName);
            } else {
                # code...
                $data = $this->model::find($request->id);
                $data->update([
                    "name" => $request->name,
                    "display_name" => $request->display_name,
                    "email" => $request->email,
                    "description" => $request->description,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "departement" => $request->departement,
                    "status" => $request->status,
                ]);

                $user = $this->model::find($request->id);
                $role = $this->role::find($request->role);
                $user->syncRoles([$role->name]);
            }
            return ["status"=>"success", "message"=>"Data updated succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    public function update_profile($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required|numeric",
                'email' => [
                    'required', 'email', 'string', 'max:255',
                    Rule::unique('users', 'email')->where(function ($query) {
                        $query->where('id', '<>', request()->id);
                    }),
                ],
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            if ($request->hasFile('picture')) {
                $pictureName = env('APP_URL') . '/storage/image_uploaded/' .  $this->uploadPictureHelper($request);
                $data = $this->model::find($request->id);
                $oldPictureName = $data->picture;
                $data->update([
                    "name" => $request->name,
                    "display_name" => $request->display_name,
                    "email" => $request->email,
                    "description" => $request->description,
                    "picture" => $pictureName,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "departement" => $request->departement,
                ]);
                $this->deleteLocalPictureHelper($oldPictureName);
            } else {
                # code...
                $data = $this->model::find($request->id);
                $data->update([
                    "name" => $request->name,
                    "display_name" => $request->display_name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "description" => $request->description,
                    "address" => $request->address,
                    "departement" => $request->departement,
                ]);
            }
            return ["status"=>"success", "message"=>"Data updated succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }

    public function updatePassword($request, $id){

        try {
            $validator = Validator::make($request->all(), [
                "old_password" => "required",
                "new_password" => "required|min:8",
                "password_confirmation" => "required|min:8"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            if($request->new_password != $request->password_confirmation){
                throw new Exception("Password confirmation does not match.");
            }

            $user = $this->model::find($request->id);
            if(!Hash::check($request->old_password, $user->password)){
                throw new Exception("Password does not match.");
            } else {
                $user->update([
                    "password"=>Hash::make($request->new_password)
                ]);
            }
            return ["status" => "success", "message" => "Password changed succesfully."];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            $data = $this->model::find($id);
            if($data->id == Auth::user()->id)
            {
                throw new Exception("You can't delete yourself.");
            }
            else
            {
                $this->deleteLocalPictureHelper($data->picture);
                $data->delete();

                return ["status" => "success", "message" => "User deleted succesfully."];
            }
            return true;
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }

    public function uploadPhotoPic($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "picture" => "required|image|max:2048",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            if ($request->hasFile('picture')) {
                // Getting picture name after uploaded
                $pictureName = env('APP_URL') . '/storage/image_uploaded/' .  $this->uploadPictureHelper($request);
                $info = $this->model::find($id);
                $oldPictureName = $info->picture;
                $info->update([
                    "picture" => $pictureName,
                ]);
                $this->deleteLocalPictureHelper($oldPictureName);
                return ["status" => "success", "message" => "Data updated succesfully."];
            }
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }

    public function deletePhotoPic($id)
    {
        try {
            $data = $this->model::find($id);
            $data->update([
                'picture' => null
            ]);
            $pictureName = $data->picture;
            $this->deleteLocalPictureHelper($pictureName);
            return ["status" => "success", "message" => "Image deleted succesfully."];
        } catch (\Throwable $th) {
            return ["status" =>"error", "message"=>$th->getMessage()];
        }
    }

    private function uploadPictureHelper($request)
    {
        try {
            $picture = $request->file('picture');
            $pictureName = $picture->hashName();
            $picture->storeAs("public/image_uploaded", $pictureName);
            return $pictureName;
        } catch (\Throwable $th) {
            return null;
        }
    }

    private function deleteLocalPictureHelper($fileName)
    {
        try {
            if ($fileName != "") {
                Storage::disk('local')->delete('public/image_uploaded/' . $fileName);
                return null;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
