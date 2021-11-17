<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            $products = Products::where('main_category_id', $category->id)->orderBy('hits','desc')->take(33)->get();
            $products_subset = $products->map->only(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image']);
            return $products_subset;
        } catch (\Throwable $th) {
            return response()->json('No similar products found', Response::HTTP_NOT_FOUND);
        }
    }
}
