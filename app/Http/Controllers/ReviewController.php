<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    /*create and save new review for recipe*/

    public function postReview(Request $request, $recipeId)
    {
        //validation
        $this->validate($request, [
            'comment' => 'required',
            'star' => 'required'
        ]);

        $recipe = Recipe::find($recipeId);

        $review = new Review();
        $review->user_id = auth()->id();
        $review->comment = $request->get('comment');
        $review->rating = $request->get('star');
        $review->recipe_id = $recipe->id;

        $review->save();


        //after the review is saved, update the current rating average for this recipe

        $sumAllRatings = $recipe->reviews()->sum('rating');
        $reviewsCount = $recipe->reviews()->count();
        $reviewsAvg = round(($sumAllRatings / $reviewsCount),0);

        DB::table('recipes')->where('id', $recipe->id)->update([
            'rating_average' => $reviewsAvg
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }


}
