<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MainCategory;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\ShoppingSession;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemController extends Controller
{
    public function addOrderItem(Request $request, $userId)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'totalSum' => 'required',
            'fee' => 'required',
            'usdP' => 'required',
            'selectedProps' => 'required',
            'uri' => 'required',
            'user_id' => 'required',
            'productId' => 'required',
            'shopping_session_id' => 'required',
        ]);

        $user = User::find($userId);
        $orderItem = $user->orderItems()->create($request->all());

        return response()->json(null, 200);
    }

    public function fetchOrderItem($userId)
    {
        $user = User::find($userId);

        return $user->orderItems;
    }

    public function deleteOrderItem(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->delete();
        ShoppingSession::calcSessionTotal($orderItem->shoppingSession->id);

        return response()->json('Item deleted', Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);

        $this->validate($request, [
            'totalSum' => 'required|integer',
            'fee' => 'required|integer',
            'usdP' => 'required|numeric',
            'shippingCost' => 'required|integer',
            'shippingTime' => 'required|string',
        ]);

        $orderItem->update($request->all());

        $total = 0;
        $totalFee = 0;
        $totalShippingCost = 0;

        $order = ShoppingSession::find($orderItem->shopping_session_id);
        foreach ($order->orderItems as $orderItem) {
            $total += $orderItem->totalSum;
            $totalFee += $orderItem->fee;
            $totalShippingCost += $orderItem->shippingCost;
        }
        $order->total = $total;
        $order->totalFee = $totalFee;
        $order->totalShipping = $totalShippingCost;
        $order->save();

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function searchInput(Request $request, $productId)
    {
        $this->validate($request, [
            'title' => 'required',
            'productId' => 'required',
            'image' => 'required',
            'minPrice' => 'required|integer',
            'maxPrice' => 'required|integer',
            'equalPrice' => 'required|integer',
            'link' => 'required',
        ]);

        $mainCat = MainCategory::where('catId', $request->input('mainCatId'))->first();
        if (!$mainCat) {
            $mainCat = MainCategory::create([
                'catId' => $request->input('mainCatId'),
                'name' => $request->input('mainCatName'),
            ]);
        }

        $cat = Category::where('catId', $request->input('catId'))->first();
        if (!$cat) {
            $cat = Category::create([
                'catId' => $request->input('catId'),
                'name' => $request->input('catName'),
                'main_category_id' => $mainCat->id,
            ]);
        }

        $subCat = SubCategory::where('catId', $request->input('subCatId'))->first();
        if (!$subCat) {
            $subCat = SubCategory::create([
                'catId' => $request->input('subCatId'),
                'name' => $request->input('subCatName'),
                'main_category_id' => $mainCat->id,
                'category_id' => $cat->id,
            ]);
        }

        $product = Products::where('productId', $request->input('productId'))->first();

        if ($product) {
            ++$product->hits;
            $product->minPrice = $request->input('minPrice');
            $product->maxPrice = $request->input('maxPrice');
            $product->equalPrice = $request->input('equalPrice');
            if($product->sub_category_id == 0) {
                $product->main_category_id = $mainCat->id;
                $product->category_id = $cat->id;
                $product->sub_category_id = $subCat->id;
            }
            $product->save();

            return response()->json('Item updated', Response::HTTP_NO_CONTENT);
        }

        $product = Products::create([
            'title' => $request->input('title'),
            'productId' => $request->input('productId'),
            'image' => $request->input('image'),
            'minPrice' => $request->input('minPrice'),
            'maxPrice' => $request->input('maxPrice'),
            'equalPrice' => $request->input('equalPrice'),
            'link' => $request->input('link'),
            'main_category_id' => $mainCat->id,
            'category_id' => $cat->id,
            'sub_category_id' => $subCat->id,
        ]);

        return response()->json('Item created', Response::HTTP_CREATED);
    }

    public function update_shippingCost(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->shippingCost = $request->input('shippingCost');
        $orderItem->save();

        return redirect()->back()->with('success', 'Shipping Cost updated!');
    }
}
