<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function fetchSimilar(Request $request, $prodId)
    {
        $product = Products::where('productId', $prodId)->first();
        if (!$product) {
            return $products = Products::orderBy('hits', 'desc')->take(15)->get(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image'])->toArray();
        }

        return Products::where('main_category_id', $product->main_category_id)->orderBy('hits', 'desc')->take(15)->get(['equalPrice', 'minPrice', 'maxPrice', 'link', 'image'])->toArray();
    }
}
