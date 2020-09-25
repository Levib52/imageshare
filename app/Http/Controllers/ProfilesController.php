<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
        return view('user.index', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('user.edit-profile', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'instagram' => '',
            'twitter' => '',
            'bio' => '',
            'location' => '',
            'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        ]);

        if(request('profileImage')) {
            $profileImagePath = request('profileImage')->store('profile', 'public');

            $profileImage = Image::make(public_path("storage/{$profileImagePath}"))->fit(1000, 1000);
            $profileImage->save();

            $profileImageArray = ['profileImage' => $profileImagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $profileImageArray ?? []
        ));

        return redirect("/user/{$user->id}");
    }
}
