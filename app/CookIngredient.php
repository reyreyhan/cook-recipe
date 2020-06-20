<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookIngredient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cook_id', 'ingredient_id', 'information'
    ];

    public function ingredient() {
        return $this->belongsTo('App\Ingredient', 'ingredient_id', 'id');
    }
}
