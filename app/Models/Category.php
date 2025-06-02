<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

 public function parentCategory()
{
    return $this->belongsTo(Category::class, 'parent_id');
}
public function subCategories()
{
    return $this->hasMany(Category::class, 'parent_id');
}
public static function getCategories()
{
   $getCategories = Category::with(['subCategories'=>function($query){
        $query->with('subCategories');
   }])->where('parent_id', '0')->where('status', '1')->get();
  
   return $getCategories;
}
} 