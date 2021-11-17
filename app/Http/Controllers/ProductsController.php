<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\Products;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    public function fetchSimilar(Request $request, $catId)
    {
        try {
            $category = MainCategory::where('catId', $catId)->firstOrFail();
        } catch (\Throwable $th) {
            return $th;
        }
            $products = Products::where('main_category_id', $category->id)->orderBy('hits','desc')->take(15)->get(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image'])->toArray();
            // $products_subset = $products->map->only(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image']);
            return $products;
    }
}
