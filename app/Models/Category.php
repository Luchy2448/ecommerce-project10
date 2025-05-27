<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parentCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id')->select(['id', 'name', 'url'])->where('status', 1);
    }
}
