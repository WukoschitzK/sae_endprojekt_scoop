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
    public function show($id)
    {
        $user = Auth::user();
        $followers = $user->followers();

        $followings = $user->leaders()->get();

        //get recipes from all the people i'm following
        $followingArray = [];

//        $recipes = Recipe::query();

        foreach($followings as $followingUser) {
            array_push($followingArray, $followingUser->id);
        }

        $recipes = Recipe::whereIn('user_id', $followingArray)->orderBy('created_at', 'desc')->get();

//        $recipes = DB::table('recipes')->whereIn('user_id', $followingArray)->orderBy('created_at', 'desc')->get();



//        foreach($followingArray as $id) {
//            $recipes = $recipes->whereHas('user', function ($query) use ($id) {
//                $query->where('user_id',  $id);
//            });
//        }
//
//        dd($followingArray);

//        $recipes = $recipes->where('is_public', true)->orderBy('created_at','desc')->get();
//dd($recipes);
//        $recipes = DB::table('recipes')->whereIn('user_id', $followingArray)->orderBy('created_at', 'desc')->get();

        return view('profile.show', compact('recipes','user', 'followers','followings'));


//        $user = User::find($id);
//
////        $recipes = Recipe::where('user_id', $id)->get();
//        $followers = $user->followers();
//
//
//
//        $followings = $user->leaders()->get();
//
//
//        //get recipes from all the people i'm following
//
//        $followingArray = [];
//
//        foreach($followings as $followingUser) {
//            array_push($followingArray, $followingUser->id);
//        }
//
//        $recipes = DB::table('recipes')->whereIn('user_id', $followingArray)->orderBy('created_at', 'desc')->get();
//
//
//        return view('profile.show', compact('user', 'recipes', 'followers'));
    }

    public function showOtherProfile($id) {
        $user = User::find($id);

        $recipes = Recipe::where('user_id', $id)->where('is_public',true)->get();
        $followers = $user->followers();

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

    public function update(Request $request, $id)
    {
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

    public function follow($id)
    {
        $leading_user = User::find($id);
        $following_user = auth()->user()->id;

        $leading_user->followers()->attach($following_user);

        return redirect()->back()->with('success', 'Successfully followed');
    }

    public function unfollow($id)
    {
        $leading_user = User::find($id);
        $following_user = auth()->user()->id;

        $leading_user->followers()->detach($following_user);

        return redirect()->back()->with('success', 'Successfully unfollowed');
    }

//    public function showFollower(int $userId)
//    {
//        $user = User::find($userId);
//        $followers = $user->followers;
//        $followings = $user->followings;
//        return view('user.showFollower', compact('user', 'followers' , 'followings');
//    }

    public function showMyFollowing($userId) {

        $user = User::find($userId);
        $followings = $user->leaders()->get();

        return view('profile.showMyFollowing', compact('followings'));
    }


}
