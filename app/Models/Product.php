<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id')->with('parentCategory');
    }
    public static function productsFilters(){

        $productsFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool', 'Silk', 'Linen');
        $productsFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', '3/4 Sleeve', 'Sleeveless');
        $productsFilters['patternArray'] = array('Solid', 'Printed', 'Striped', 'Checked', 'Floral', 'Geometric', 'Abstract', 'Plain');
        $productsFilters['fitArray'] = array('Regular Fit', 'Slim Fit', 'Loose Fit'); 
        $productsFilters['occasionArray'] = array('Casual', 'Formal', 'Party', 'Sports', 'Wedding');
        $productsFilters['sizeArray'] = array('U', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL');

        return $productsFilters;
    }
}
