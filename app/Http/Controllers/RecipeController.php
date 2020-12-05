<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
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
    public function index()
    {
//        $recipes = Recipe::with('user')->get();
        $recipes = Recipe::orderBy('created_at','desc')->paginate(9); //;
        $categories = Category::all();
        $allergens = Allergen::all();

        //return view('recipes.index', compact('recipes'));

//        return response()->json($recipes);

//        if (request()->has('5')) {
//            $recipes = Recipe::where('category_id', request('5'))->paginate(9)->appends('5', request('5'));
//        } else {
//            $recipes = Recipe::orderBy('created_at','desc')->paginate(9);
//        }



//        $recipes = Recipe::all();
        $queries = [];

        $columns = [
          'category_id',
//          'allergen_id',
        ];

        foreach($columns as $column) {
            if(request()->has($column)) {
                $recipes = $recipes->where($column, request($column)); //orderBy('created_at','desc')->paginate(9);
                $queries[$column] = request($column);
            }
        }


        return view('recipes.index', compact('recipes', 'categories', 'allergens'));
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


        return view('recipes.create', compact('recipe','allergens', 'categories'));
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

            'title' => 'required|min:3|max:192',
            //'text' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png',
        ]);

        $recipe = new Recipe();
        $recipe->fill($request->all());
        // $posting->title = $request->get('title');
        // $posting->text = $request->get('text');
        $recipe->is_public = $request->has('is_public');
        $recipe->user_id = auth()->id();

//      $ingredients = $request->get('ingredients');

//        $ingredients = [];

//        for ($i = 0; $i < count($request->get('ingredient')); $i++) {
//            $ingredients = $ingredients.push($request->get(ingredient)[$i]);
//        }

//        $requestIngredients = $request->get('ingredient');

//        dd($request->get('ingredient'));

//        foreach ($requestIngredients as $ingredient) {
////            $ingredients->push($ingredient);
//            dd($ingredient);
//        }

        $recipe->ingredients = $request->get('ingredient');
        $recipe->steps = $request->get('steps'); //oder step?

        $recipe->category_id = $request->get('category');

//        DB::insert('INSERT INTO categories ()')

//        dd($ingredients);


//        $recipe->ingredients = $ingredients);
//
//        if ($image = $request->file('image')) {
//
//            $name = Str::random(16) . '.' . $image->getClientOriginalExtension();
//            $image->storePubliclyAs('public/images/recipe_images', $name);
//            $recipe->image_path = $name;
//        }


//        for ($i=0; $i<count($request->ingredient); ++$i){
//            $ingredient_id = Ingredient::firstorCreate(['name' => $request->ingredient[$i]])->id;
//
//            $recipe->ingredients()->attach($ingredient_id);
//        }
//        DB::transaction(function()
//        {
//            DB::table('users')->update(['votes' => 1]);
//
//            DB::table('posts')->update();
//        });



        $recipe->save();

        //        ------allergens------

        foreach ($request->get('allergens') as $allergen) {
            DB::insert("INSERT INTO allergen_recipe (allergen_id, recipe_id) VALUES ('". $allergen ."', '". $recipe->id ."'); ");
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

        $user = User::find($user_id);

        $allergens = $recipe->allergens()->get();

        return view('recipes.show', compact('recipe', 'user', 'allergens'));
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
        $allergens = Allergen::all();

//        dd($recipe->ingredients);

        return view('recipes.edit', compact('recipe','allergens'));
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

            'title' => 'required|min:3|max:192',
            'text' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png'
        ]);

        $recipe = Recipe::find($id);
        $recipe->fill($request->all());
        $recipe->is_public = $request->has('is_public');



//        ------ingredients------

//        $recipe->ingredients = $request->get('ingredient');
        $recipe->steps = $request->get('steps'); //oder step?


        $newIngredients = $request->get('ingredient');
        $oldIngredients  = $recipe->ingredients;

        $newArray = array_merge($oldIngredients, $newIngredients);

        $recipe->ingredients = $newArray;

//        todo: remove specific item of array




        $recipe->save();

        return redirect()->route('recipes.show', $id)->with('success', 'Recipes updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if($recipe->image_path) {
            Storage::delete('public/images/'.$recipe>image_path);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipes deleted!');
    }

    public function showMyRecipes($user_id) {


//        $recipes = Recipe::query()->where('user_id', $user_id)->pluck('following_user_id')->orderBy('created_at', 'desc')->get();
        $recipes = Recipe::query()->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('recipes.showMyRecipes', compact('recipes'));

    }

    public function showLatestRecipes() {

        $recipes = Recipe::query()->orderBy('created_at', 'desc')->take(3)->get();
//dd($recipes);
        return view('welcome', compact('recipes'));
    }

    public function showMyFavorites($user_id) {


//        $recipes = Recipe::query()->where('user_id', $user_id)->pluck('following_user_id')->orderBy('created_at', 'desc')->get();
//        $recipes = Recipe::query()->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

//        todo:

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
//        $recipe_id->userFavorite()->attach($user_id);

        return redirect()->back()->with('success', 'Successfully added as Favorite!');
    }

    public function removeFavorite($id) {
//        $user = auth()->user()->id;
//        $user = User::find($user);
        $user_id = Auth::user();

        $recipe = Recipe::find($id);
        $recipe_id = $recipe->id;

        $user_id->favoriteRecipe()->detach($recipe_id);
//        $recipe_id->userFavorite()->attach($user_id);

        return redirect()->back()->with('success', 'Successfully removed from Favorites!');
    }
}
