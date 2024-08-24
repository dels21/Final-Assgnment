<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $currentUserID = Auth::user()->id;

    $userAvatarIDs = UserAvatar::where('user_id', '=', $currentUserID)
                        ->pluck('avatar_id')
                        ->toArray();

    $dataAvatar = Avatar::whereNotIn('id', $userAvatarIDs)->get();

    return view('shop', compact('dataAvatar'));
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
        //
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
}
