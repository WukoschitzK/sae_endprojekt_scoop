<?php

namespace App\Http\Controllers;


use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        $recipes = Recipe::with('user')->get();
        $followers = $user->followers();

        return view('profile.show', compact('user', 'recipes', 'followers'));
    }

    public function showOtherProfile($id) {
        $user = User::find($id);

        $recipes = Recipe::with('user')->get();
        $followers = $user->followers();

        return view('profile.showOtherProfile', compact('user', 'recipes', 'followers'));
    }

    public function edit(Request $request, $id)
    {
        $userId = Auth::id();

        $user = User::find($id);
        $user->fill($request->old());

        if (!$userId == $user->id) {
            return redirect()->route('recipes.index');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        return redirect()->route('profile.show', $id)->with('success', 'User updated!');

//        return response()->json($recipe);
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

//    public function showFollower(int $userId)
//    {
//        $user = User::find($userId);
//        $followers = $user->followers;
//        $followings = $user->followings;
//        return view('user.showFollower', compact('user', 'followers' , 'followings');
//    }
}
