<?php

namespace App\Http\Controllers;

use App\Models\ShoppingSession;
use App\Models\User;
// use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;

class ShoppingSessionController extends Controller
{
    // use StoreImageTrait;
    
    public function addToCart(Request $request, $userId)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'totalSum' => 'required',
            'uri' => 'required',
            'user_id' => 'required',
            'productId' => 'required',
            'fee' => 'required',
            'usdP' => 'required',
            'shippingCost' => 'required',
            'shippingTime' => 'required',
        ]);
        $user = User::find($userId);
        $activeShoppingSession = $user->shoppingSessions->where('status', 'Active')->first();
        
        if($activeShoppingSession) {
            $activeShoppingSession->orderItems()->create($request->all());
            $this->calcSessionTotal($activeShoppingSession);
        } else {
            return response()->json('Problem adding to cart (No active shoppinSessions found', Response::HTTP_NOT_FOUND);
        }

        return response()->json('Item created', Response::HTTP_CREATED);
    }

    public function fetchOrderItems(Request $request, $userId)
    {
        $user = User::find($userId);
        
        $activeShoppingSession = $user->shoppingSessions->where('status', 'Active')->first();

        if(!$activeShoppingSession) {
            $shoppingSession = $user->shoppingSessions()->create();
        } else {
            return $activeShoppingSession->orderItems;
        }
    }

    public function calcSessionTotal(ShoppingSession $shoppingSession)
    {
        $total = 0;
        $totalFee = 0;
        $totalShipping = 0;
        foreach ($shoppingSession->orderItems as $orderItem) {
            $total = $total + $orderItem->totalSum;
            $totalFee = $totalFee + $orderItem->fee;
            $totalShipping = $totalShipping + $orderItem->shippingCost;
        }

        $shoppingSession->update([
            'total' => $total,
            'totalFee' => $totalFee,
            'totalShipping' => $totalShipping,
        ]);
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function storeImage(Request $request, $id)
    {
        
         $request->validate([
            'confirmation_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        
        $order = ShoppingSession::find($id);
        $price = $order->total + $order->totalShipping;
        $imageName = $price.'DA-'.Auth::user()->phone.'-'.date("Y-m-d-H:i:s",time()).'.'.$request->confirmation_image->extension();  
     
        // $image = $request->confirmation_image->storeAs('public/images/order-confirmationz', $imageName);  

        $image = $request->file('confirmation_image');
        $filePath = 'public/images/order-confirmationz/';
        $img = Image::make($image)->resize(920, 690, function ($const) {
            $const->aspectRatio();
        })->encode();

        //Put file with own name
        Storage::put($imageName, $img);
        //Move file to your location 
        Storage::move($imageName, 'public/images/order-confirmationz/' . $imageName);

        $order->confirmations()->create([
            'shopping_session_id' => $id,
            'path' => $filePath.$imageName,
        ]);

        $order->withPayment = true;
        $order->save();
 
        return redirect(route('account'));
 
    }

    public function delete(Request $request, $id)
    {
        $order = ShoppingSession::find($id);
        $order->delete();

        return back()->with('success', 'Votre commande a été supprimée');
    }
}
