<?php

namespace App\Http\Controllers;


use App\Models\Allergen;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{

    /*Show user profile*/

    public function show($id)
    {
        $user = Auth::user();
        $followers = $user->followers();
        $followings = $user->leaders()->get();


        //get the latest recipes from all the people i'm following

        $followingArray = [];

        foreach($followings as $followingUser) {
            array_push($followingArray, $followingUser->id);
        }

        $recipes = Recipe::whereIn('user_id', $followingArray)->orderBy('created_at', 'desc')->get();

        return view('profile.show', compact('recipes','user', 'followers','followings'));
    }


    /*Show other user profile*/

    public function showOtherProfile($id) {

        $user = User::find($id);
        $recipes = Recipe::where('user_id', $id)->where('is_public',true)->get();
        $followers = $user->followers();


        //we need to know if the auth user is already following to this user, to show the correct btn (follow / unfollow)

        $isAlreadyFollowing = false;

        $auth_user = Auth::user();
        $auth_user_followings = $auth_user->leaders()->get();

        foreach($auth_user_followings as $following) {
            if($following->id == $user->id) {
                $isAlreadyFollowing = true;
            }
        }

        return view('profile.showOtherProfile', compact('user', 'recipes', 'followers','isAlreadyFollowing'));
    }

    /*Form for edit user profile*/

    public function edit(Request $request, $id)
    {
        $userId = Auth::id();

        $user = User::find($id);
        $user->fill($request->old());

        $allergens = Allergen::all();

        if (!$userId == $user->id) {
            return redirect()->route('recipes.index');
        }

        return view('profile.edit', compact('user', 'allergens'));
    }


    /*Update user profile*/

    public function update(Request $request, $id)
    {
        //validation

        $validatedData = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|string|min:4',
            'preferred_content' => 'required|min:1|max:50'
        ]);

        $user = User::find($id);
        $user->name =$validatedData["name"];
        $user->email = $validatedData["email"];
        $user->preferred_content =$validatedData["preferred_content"];


        //the password must not be declared when the user wants to change his profile
        //for that, the password will only be overwritten if the user has filled the password input field

        if (!empty($validatedData["password"])) {
            $user->password = $validatedData["password"];
        }

        if ($image = $request->file('image')) {
            $name = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $image->storePubliclyAs('public/images/profile_images', $name);
            $user->image_path = $name;
        }

        $user->save();

        return redirect()->route('profile.show', $id)->with('success', 'Successfully updated');

    }


    /*Follow user*/

    public function follow($id)
    {
        $leading_user = User::find($id);
        $following_user = auth()->user()->id;

        $leading_user->followers()->attach($following_user);

        return redirect()->back()->with('success', 'Successfully followed');
    }


    /*Unfollow user*/

    public function unfollow($id)
    {
        $leading_user = User::find($id);
        $following_user = auth()->user()->id;

        $leading_user->followers()->detach($following_user);

        return redirect()->back()->with('success', 'Successfully unfollowed');
    }


    /*Get all the followings from current user*/

    public function showMyFollowing($userId) {

        $user = User::find($userId);
        $followings = $user->leaders()->get();

        return view('profile.showMyFollowing', compact('followings'));
    }


}
