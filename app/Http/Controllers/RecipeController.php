<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*All Recipes Page inclusive Filter for Allergens and Categories*/

    public function index(Request $request)
    {
        $categories = Category::all();
        $allergens = Allergen::all();

        $recipes = Recipe::query();

        //show recipes for selected category, or if category is "all"-category show all recipes

        if(isset($request->cat)) {
            $requestedCategoryName = $categories->where('id',$request->cat)->where('name', 'All');

            if(!$requestedCategoryName->isEmpty()) {
                $categoryIds = [];
                foreach($categories as $category) {
                    array_push($categoryIds, $category->id);
                }

                $recipes = $recipes->whereIn('category_id', $categoryIds );
            } else {
                $category_id = $request->cat;
                $recipes = $recipes->where('category_id', $category_id );
            }
        }

        //show recipes for selected allergens (and category)

        if(isset($request->allergens)) {
            $allergen_ids = $request->get('allergens');

            foreach(explode(',', $allergen_ids) as $id) {

                $recipes = $recipes->whereHas('allergens', function ($query) use ($id) {
                    $query->where('allergen_id',  $id);
                });
            }
        }
        $recipes = $recipes->where('is_public', true)->orderBy('created_at','desc')->paginate(9);

        response()->json($recipes); //return to ajax
        return view('recipes.index', compact('recipes','allergens','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*View for new recipe form*/

    public function create(Request $request)
    {
        $recipe = new Recipe();
        $recipe->fill($request->old());

        $allergens = Allergen::all();
        $categories = Category::select('*')->where('name', '!=', "All")->get();


        return view('recipes.create', compact('recipe', 'categories','allergens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /*Store function for new recipes*/

    public function store(Request $request)
    {
        //validate input fields

        $this->validate($request, [
            'title' => 'required|min:3|max:35',
            'description' => 'required|min:3|max:150',
            'image' => 'nullable|mimes:jpeg,png',
            'ingredient' => 'array|required|min:1|max:150',
            'ingredient.*' => 'required|string',
            'steps' => 'array|filled|required|min:1|max:150',
            'steps.*' => 'string|min:1',
            'category' => 'required'
        ]);

        //create recipe

        $recipe = new Recipe();
        $recipe->fill($request->all());
        $recipe->is_public = $request->has('is_public');
        $recipe->user_id = auth()->id();

        $recipe->ingredients = $request->get('ingredient');
        $recipe->steps = $request->get('steps');

        $recipe->category_id = $request->get('category');

        //image upload

        if ($image = $request->file('image')) {

            $name = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $image->storePubliclyAs('public/images/recipe_images', $name);
            $recipe->image_path = $name;
        }

        $recipe->save();


        //if the recipes has allergens selected, new entry for allergens table

        if($request->get('allergens') != null) {
            foreach ($request->get('allergens') as $allergen) {

                DB::insert("INSERT INTO allergen_recipe (allergen_id, recipe_id) VALUES ('". $allergen ."', '". $recipe->id ."'); ");
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe succesfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*Show all information from a specific recipe*/

    public function show($id)
    {
        $recipe = Recipe::find($id);
        $user_id = $recipe->user_id;

        //if the recipe is from the current (logged in) user, show edit btn

        $isAuthUser = false;

        if(Auth::user() != null) {
            $authUser_id = Auth::user()->id;

            if($authUser_id == $recipe->user_id) {
                $isAuthUser = true;
            }
        }

        $reviews = $recipe->reviews()->get();

        $user = User::find($user_id);

        //for the view, we need to highlight the selected allergens (color filled)
        //for that, we need two arrays for the allergens: on for the selected allergens of the recipe and one for all possible allergens

        $allergens = $recipe->allergens()->get();

        $allergenArray = [];

        foreach($allergens as $allergen) {
            array_push($allergenArray, $allergen->id);
        }

        $query = DB::table("allergens");
        foreach($allergenArray as $allergenArrayItem){
            $query->where("id",'!=',$allergenArrayItem);
        }

        $allAllergens = $query->get();

        return view('recipes.show', compact('recipe', 'user', 'allergens','allAllergens', 'reviews','isAuthUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*Form for edit recipe*/

    public function edit(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->fill($request->old());
//        $category =  $recipe->category()->get();
        $categories = Category::all();
        $categories = $categories->where('name','!=', 'All');


        //for the view, we need to highlight the selected allergens (color filled)
        //for that, we need two arrays for the allergens: on for the selected allergens of the recipe and one for all possible allergens

        $allergens = $recipe->allergens()->get();

        $allergenArray = [];

        foreach($allergens as $allergen) {
            array_push($allergenArray, $allergen->id);
        }

        $query = DB::table("allergens");
        foreach($allergenArray as $allergenArrayItem){
            $query->where("id",'!=',$allergenArrayItem);
        }

        $allAllergens = $query->get();

        return view('recipes.edit', compact('recipe','allergens','allAllergens','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*Function for update the edited recipe*/

    public function update(Request $request, $id)
    {
        //validation

        $this->validate($request, [
            'title' => 'required|min:3|max:35',
            'description' => 'required|min:3|max:150',
            'image' => 'nullable|mimes:jpeg,png',
            'ingredient' => 'array|required|min:1',
            'ingredient.*' => 'required|string',
            'steps' => 'array|filled|required|min:1',
            'steps.*' => 'string|min:1',
            'category' => 'required'
        ]);

        $recipe = Recipe::find($id);
        $recipe->fill($request->all());
        $recipe->is_public = $request->has('is_public');
        $recipe->steps = $request->get('steps'); //oder step?
        $recipe->ingredients = $request->get('ingredient');
        $recipe->category_id = (int)$request->get('category');

        //image upload
        if ($image = $request->file('image')) {

            $name = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $image->storePubliclyAs('public/images/recipe_images', $name);
            $recipe->image_path = $name;
        }

        $recipe->save();

        //add or remove allergens

        //1. get the currently selected allergens

        $prevAllergens = $recipe->allergens()->get();

        $prevAllergenArray = [];

        foreach($prevAllergens as $prevAllergen) {
            array_push($prevAllergenArray, $prevAllergen->id);
        }

        //2. get all the allergens which are not selected

        $query = DB::table("allergens");
        foreach($prevAllergenArray as $allergenArrayItem){
            $query->where("id",'!=',$allergenArrayItem);
        }

        $leftAllergens = $query->get();

        //get the new selected allergens from request

        $newAllergensArray = [];

        if($request->get('allergens') != null) {
            foreach($request->get('allergens') as $id) {
                $allergenId = (int)$id;
                array_push($newAllergensArray, $allergenId);
            }

            //3. insert the new allergens in allergens-table

            //shows the new allergens
            $differenceNew = array_diff($newAllergensArray, $prevAllergenArray);

            foreach ($differenceNew as $allergen) {
                DB::insert("INSERT INTO allergen_recipe (allergen_id, recipe_id) VALUES ('". $allergen ."', '". $recipe->id ."'); ");
            }
        }

        //4. remove allergens from allergens-table

        // shows the removed allergens
        $differenceRemove = array_diff($prevAllergenArray, $newAllergensArray);

        foreach ($differenceRemove as $allergen) {
            DB::table('allergen_recipe')->where('allergen_id',$allergen)->where('recipe_id',$recipe->id)->delete();
        }

        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recipes updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*Delete recipe*/

    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        //delete entry for image in storage

        if($recipe->image_path) {
            Storage::delete('public/images/recipe_images'.$recipe->image_path);
        }

        //delete entry in allergens-table

        $allergens = $recipe->allergens()->get();

        foreach ($allergens as $allergen) {
            DB::table('allergen_recipe')->where('allergen_id',$allergen)->where('recipe_id',$recipe->id)->delete();
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipes deleted');
    }


    /*Show all recipes from currently logged in user*/

    public function showMyRecipes($user_id) {

        $recipes = Recipe::query()->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('recipes.showMyRecipes', compact('recipes'));

    }


    /*Show latest recipes*/

    public function showLatestRecipes() {

        $recipes = Recipe::query()->where('is_public', true)->orderBy('rating_average', 'desc')->orderBy('created_at', 'desc')->take(3)->get();

        return view('welcome', compact('recipes'));
    }


    /*Show favorite recipes from currently logged in user*/

    public function showMyFavorites($user_id) {

        $user_id = Auth::user();
        $recipes = $user_id->favoriteRecipe()->get();

        return view('recipes.showMyFavorites', compact('recipes'));
    }


    /*Save recipe to favorites*/

    public function addFavorite($id) {
        $user = auth()->user()->id;
        $user = User::find($user);
        $user_id = Auth::user();

        $recipe = Recipe::find($id);
        $recipe_id = $recipe->id;

        $user_id->favoriteRecipe()->attach($recipe_id);

        return redirect()->back()->with('success', 'Added as Favorite');
    }


    /*Remove recipe to favorites*/

    public function removeFavorite($id) {
        $user_id = Auth::user();

        $recipe = Recipe::find($id);
        $recipe_id = $recipe->id;

        $user_id->favoriteRecipe()->detach($recipe_id);

        return redirect()->back()->with('success', 'Removed from Favorites');
    }


    /*Search for recipes*/

    public function search(Request $request)
    {
        $search = $request->get('search');

        $recipes = Recipe::where('title','like','%'.$search.'%')
            ->where('is_public', true)
            ->orWhere('description','like','%'.$search.'%')
            ->orWhere('ingredients','like','%'.$search.'%')->get();


        return view('recipes.search', compact('recipes'));
    }
}
