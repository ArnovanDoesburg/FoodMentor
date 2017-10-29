<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodList extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'FoodList';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'category_id', 'user_id'];
}
