<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function fetchSimilar(Request $request, $catId)
    {
        $category = MainCategory::where('catId', $catId)->first();
        if (!$category) {
            return $products = Products::orderBy('hits', 'desc')->take(15)->get(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image'])->toArray();
        }

        return Products::where('main_category_id', $category->id)->orderBy('hits', 'desc')->take(15)->get(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image'])->toArray();
    }
}
