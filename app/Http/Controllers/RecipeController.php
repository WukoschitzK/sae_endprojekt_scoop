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
    public function index(Request $request)
    {
        $recipes = Recipe::where('is_public', true)->orderBy('created_at','desc')->paginate(9); //;
        $categories = Category::all();
        $allergens = Allergen::all();




        $recipes = Recipe::query();


        if(isset($request->cat)) {
            if($request->cat === "4") {

                $categoryIds = [];
                foreach($categories as $category) {
                    array_push($categoryIds, $category->id);
                }
//                $categoryIds = ["5","6","7","8"];
                $recipes = $recipes->whereIn('category_id', $categoryIds );
            } else {
                $category_id = $request->cat;
                $recipes = $recipes->where('category_id', $category_id );
            }
        }

        if(isset($request->allergens)) {
            $allergen_ids = $request->get('allergens');

            foreach(explode(',', $allergen_ids) as $id) {

                $recipes = $recipes->whereHas('allergens', function ($query) use ($id) {
                    $query->where('allergen_id',  $id);
//                    return $query;
                });
            }
        }
        $recipes = $recipes->where('is_public', true)->orderBy('created_at','desc')->get();

        response()->json($recipes); //return to ajax
        return view('recipes.index', compact('recipes','allergens','categories'));


//        if (isset($request->cat) && isset($request->allergens)) {
//
//            $allergen_ids = $request->allergens;
//            $category_id = $request->cat;
//
//            $recipesArray = [];
//
//
////            $recipes = Recipe::where($recipesArray)->get();
//
////            $recipes = Recipe::where('allergens', function (Builder $query) use ($allergen_ids) {
////                foreach($allergen_ids as $id) {
////                    $query->where('allergen_id','=',  $id);
////                }
////            })->get();
//
//
//            $recipes = Recipe::whereHas('allergens', function (Builder $query) use ($allergen_ids) {
//                $query->whereIn('allergen_id',  explode(',', $allergen_ids));
//            })->get();
//
//            $recipes->where('category_id', $category_id )->get();
//
//
//            response()->json($recipes); //return to ajax
//            return view('recipes.index', compact('recipes','allergens','categories'));
//
//        } else if (isset($request->cat)){
//
//
//            if($request->cat === 4) {
//                $recipes = Recipe::all();
//
//                response()->json($recipes); //return to ajax
//                return view('recipes.index', compact('recipes'));
//            }
//
//            $category_ids = $request->cat; //categories
//
//            $recipes = Recipe::whereIn('category_id', explode( ',', $category_ids ))->get();
//
//
//            response()->json($recipes); //return to ajax
//            return view('recipes.index', compact('recipes','allergens','categories'));
//
//        } else if (isset($request->allergens)){
//
////            if($request->allergen === 4) {
////                $recipes = Recipe::all();
////
////                response()->json($recipes); //return to ajax
////                return view('recipes.index', compact('recipes'));
////            }
//
//             //allergens
//
//
//
//            $allergen_ids = $request->allergens;
////
////            $recipes = Recipe::whereHas('allergens', function (Builder $query) use ($allergen_ids) {
////                $query->whereIn('allergen_id',  explode(',', $allergen_ids));
////            })->get();
//
//            $recipes = Recipe::whereHas('allergens', function (Builder $query) use ($allergen_ids) {
//                foreach($allergen_ids as $id) {
//                    $query = $query->where('allergen_id','=',  $id);
//                }
//                return $query;
//            })->get();
//
//            response()->json($recipes); //return to ajax
//            return view('recipes.index', compact('recipes','allergens','categories'));
//        }



//        return view('recipes.index', compact('recipes', 'categories', 'allergens'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:35',
            'description' => 'required|min:3|max:150',
            'image' => 'nullable|mimes:jpeg,png',
            'ingredient' => 'required|min:1',
            'steps' => 'required|min:1',
        ]);

        $recipe = new Recipe();
        $recipe->fill($request->all());
        $recipe->is_public = $request->has('is_public');
        $recipe->user_id = auth()->id();


        $recipe->ingredients = $request->get('ingredient');
        $recipe->steps = $request->get('steps');

        $recipe->category_id = $request->get('category');


        if ($image = $request->file('image')) {

            $name = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $image->storePubliclyAs('public/images/recipe_images', $name);
            $recipe->image_path = $name;
        }

        $recipe->save();

        //        ------allergens------

        if($request->get('allergens') != null) {
            foreach ($request->get('allergens') as $allergen) {

                DB::insert("INSERT INTO allergen_recipe (allergen_id, recipe_id) VALUES ('". $allergen ."', '". $recipe->id ."'); ");
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Recipes created!!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $user_id = $recipe->user_id;

        $isAuthUser = false;

        if(Auth::user() != null) {
            $authUser_id = Auth::user()->id;

            if($authUser_id == $recipe->user_id) {
                $isAuthUser = true;
            }
        }

        $reviews = $recipe->reviews()->get();

        $user = User::find($user_id);

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
    public function edit(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->fill($request->old());
//        $allergens = Allergen::all();
        $category =  $recipe->category()->get();
        $categories = Category::all();
        $categories = $categories->where('name','!=', 'All');


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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:35',
            'description' => 'required|min:3|max:150',
            'image' => 'nullable|mimes:jpeg,png',
            'ingredient' => 'required|min:1',
            'steps' => 'required|min:1',
        ]);

        $recipe = Recipe::find($id);
        $recipe->fill($request->all());
        $recipe->is_public = $request->has('is_public');

//        ------ingredients and steps------

        $recipe->steps = $request->get('steps'); //oder step?
        $recipe->ingredients = $request->get('ingredient');

        //        ------categories------

        $recipe->category_id = (int)$request->get('category');

        $recipe->save();

//        ------allergens------

        //1. aktuelle allergene holen und in ein array speichern

        $prevAllergens = $recipe->allergens()->get();

        $prevAllergenArray = [];

        foreach($prevAllergens as $prevAllergen) {
            array_push($prevAllergenArray, $prevAllergen->id);
        }

        //2. alle allergene die noch nicht ausgewählt wurden in ein andres array speichern
        $query = DB::table("allergens");
        foreach($prevAllergenArray as $allergenArrayItem){
            $query->where("id",'!=',$allergenArrayItem);
        }

        $leftAllergens = $query->get();

        //allergen ids welche im request mitkommen in ein array speichern

        $newAllergensArray = [];

        if($request->get('allergens') != null) {
            foreach($request->get('allergens') as $id) {
                $allergenId = (int)$id;
                array_push($newAllergensArray, $allergenId);
            }

            //3. neue allergene aus request hinzufügen in DB:

            //wenn ich wissen will was neu dazukommen is:
            $differenceNew = array_diff($newAllergensArray, $prevAllergenArray);

            foreach ($differenceNew as $allergen) {
                DB::insert("INSERT INTO allergen_recipe (allergen_id, recipe_id) VALUES ('". $allergen ."', '". $recipe->id ."'); ");
            }
        }

        //4. allergene aus DB entfernen:

        // wenn ich wissen will was im neuen nicht mehr dabei is:
        $differenceRemove = array_diff($prevAllergenArray, $newAllergensArray);

        foreach ($differenceRemove as $allergen) {
            DB::table('allergen_recipe')->where('allergen_id',$allergen)->where('recipe_id',$recipe->id)->delete();
        }

        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recipes updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        todo: bugfixing

        $recipe = Recipe::find($id);

        if($recipe->image_path) {
            Storage::delete('public/images/recipe_images'.$recipe->image_path);
        }

        $allergens = $recipe->allergens()->get();

        foreach ($allergens as $allergen) {
            DB::table('allergen_recipe')->where('allergen_id',$allergen)->where('recipe_id',$recipe->id)->delete();
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipes deleted!');
    }

    public function showMyRecipes($user_id) {

        $recipes = Recipe::query()->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('recipes.showMyRecipes', compact('recipes'));

    }

    public function showLatestRecipes() {

        $recipes = Recipe::query()->orderBy('rating_average', 'desc')->orderBy('created_at', 'desc')->take(3)->get();

        return view('welcome', compact('recipes'));
    }

    public function showMyFavorites($user_id) {

        $user_id = Auth::user();
        $recipes = $user_id->favoriteRecipe()->get();

        return view('recipes.showMyFavorites', compact('recipes'));
    }


    public function addFavorite($id) {
        $user = auth()->user()->id;
        $user = User::find($user);
        $user_id = Auth::user();

        $recipe = Recipe::find($id);
        $recipe_id = $recipe->id;

        $user_id->favoriteRecipe()->attach($recipe_id);

        return redirect()->back()->with('success', 'Successfully added as Favorite!');
    }

    public function removeFavorite($id) {
        $user_id = Auth::user();

        $recipe = Recipe::find($id);
        $recipe_id = $recipe->id;

        $user_id->favoriteRecipe()->detach($recipe_id);

        return redirect()->back()->with('success', 'Successfully removed from Favorites!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
//        dd($request->get('search'));

//        if($request->get('search') != null) {
            $recipes = Recipe::where('title','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->orWhere('ingredients','like','%'.$search.'%')->get();

//
//        $recipes->setPath('suche');
//        dd($recipes);

        return view('recipes.search', compact('recipes'));
    }
}
