<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'created_by', 'category_id'
    ];

    public function category() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function cookIngredient() {
        return $this->hasMany('App\CookIngredient', 'cook_id', 'id');
    }
}
