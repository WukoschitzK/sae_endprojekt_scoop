<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title','ingredients','steps','description','is_public','image_path'];

    protected $casts = [
        'ingredients' => 'array',
        'steps' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    public function allergens()
//    {
//        return $this->belongsToMany(Allergen::class);
//    }

//    public function allergens()
//    {
//        return $this->belongsToMany(Allergen::class, 'allergen_recipe', 'allergen_id', 'following_user_id');
//    }

    public function getImageUrlAttribute() {

        return $this->image_path ? asset('storage/images/' . $this->image_path) : null;

    }
}
