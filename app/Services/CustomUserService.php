<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Storage;

class CustomUserService implements UserServiceInterface
{
    public function create(array $data)
    {
        $save = validator($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:custom_users,email',
            'password' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ])->validate();

        $user = new CustomUser();
        $user->fill($data);
        
        if (isset($data['photo'])) {
            $photoPath = $data['photo']->store('photos', 'public');
            $user->photo = $photoPath;
        }

        $user->password = bcrypt($data['password']);
        $user->save();

        return $user;
    }

    public function update(CustomUser $user, array $data)
    {
        $validatedData = validator($data, [
            'name' => 'string',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ])->validate();

        $photo = $user->photo;

        if (isset($data['photo'])) {
            if ($photo) {
                Storage::delete($photo);
            }
            $photoPath = $data['photo']->store('photos', 'public');
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'photo' => $photoPath ?? $photo,
        ]);

        return $user;
    }

    public function delete(CustomUser $user)
    {
        if ($user->photo) {
            Storage::delete($user->photo);
        }
        $user->delete();
    }

    public function restore(CustomUser $user)
    {
        $user->restore();
    }

    public function destroyPermanently(CustomUser $user)
    {
        if ($user->photo) {
            Storage::delete($user->photo);
        }
        $user->forceDelete();
    }

    public function getAll()
    {
        return CustomUser::all();
    }

    public function getDeleted()
    {
        return CustomUser::onlyTrashed()->get();
    }

     public function find($id)
    {
        return CustomUser::findOrFail($id);
    }
}
