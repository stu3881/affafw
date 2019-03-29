<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /**
     * Generated
     */

    protected $table = 'products';
    protected $fillable = ['id', 'category_id', 'title', 'description', 'price', 'availability', 'image'];



}
