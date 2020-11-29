<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        return view('profile.show', compact('user'));
    }


    public function follow($id)
    {
        $leading_user = User::find($id);
        $following_user = auth()->user()->id;

        $leading_user->followers()->attach($following_user);

        return redirect()->back()->with('success', 'Successfully followed!');
    }

    public function unfollow($id)
    {
        $leading_user = User::find($id);
        $following_user = auth()->user()->id;

        $leading_user->followers()->detach($following_user);

        return redirect()->back()->with('success', 'Successfully unfollowed!');
    }
}
