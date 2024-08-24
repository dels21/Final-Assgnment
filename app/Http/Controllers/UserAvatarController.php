<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserID = Auth::user()->id;

        $dataAvatar = Avatar::join('user_avatars', 'user_avatars.avatar_id', '=', 'avatars.id')->where('user_avatars.user_id', '=', $currentUserID)->get(['avatars.*']);

        return view('myAvatar', compact('dataAvatar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUser = Auth::user();
        $avatar_id = $request->input('avatar_id');

        $avatar = Avatar::findOrFail($avatar_id);
        $avatarPrice = $avatar->price;

        if ($currentUser->coins < $avatarPrice) {
            return redirect()->route('avatar.index')->with('error', 'You do not have enough coins to purchase this avatar.');
        }

        $currentUser->coins -= $avatarPrice;
        $currentUser->save();

        UserAvatar::create([
            'user_id' => $currentUser->id,
            'avatar_id' => $avatar_id,
        ]);

        return redirect()->route('avatar.index')->with('success', 'Avatar successfully purchased');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateProfile(Request $request, $avatarId)
    {
        $user = Auth::user();
        $avatar = Avatar::find($avatarId);

        if (!$avatar) {
            return redirect()->back()->with('error', 'Avatar not found.');
        }

        $user->profile_path = $avatar->image_path;
        $user->save();

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }
}
