<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['id','name','status', 'slug' ];
    public $timestamps = false;

    public function products(){
        // return $this->hasMany(Product::class, 'LoaiSP', 'id');
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');


    }
    
}


