<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
//    use HasFactory;

    protected $fillable = ['name'];


//    public function recipes()
//    {
//        return $this->belongsToMany(Recipe::class, 'allergen_recipe', 'allergen_id', 'recipe_id');
//    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
