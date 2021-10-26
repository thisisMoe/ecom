<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Products;
use App\Models\ShoppingSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Spatie\QueryBuilder\QueryBuilder;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function users(Request $request)
    {
        $phone = trim($request->get('phone'));

        if (!$phone) {
            $users = User::paginate(15);
        }

        $users = User::query()->where('phone', 'like', "%{$phone}%")->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function orders(Request $request)
    {
        $orders = QueryBuilder::for(ShoppingSession::class)->allowedFilters('orderStatus', 'status', 'confirmation_image')->paginate(6)->appends(request()->query());

        $ordersCount = $orders->count();

        return view('admin.pending', compact('orders', 'ordersCount'));
    }

    public function pendingPayments(Request $request)
    {
        $orders = ShoppingSession::where(['orderStatus' => 'pending', 'withPayment' => true])->paginate(6);
        $ordersCount = ShoppingSession::where(['orderStatus' => 'pending', 'withPayment' => true])->get()->count();

        return view('admin.pending-payments', compact('orders', 'ordersCount'));
    }

    public function user_edit(Request $request, $id)
    {
        $user = User::find($id);

        return view('admin.user', compact('user'));
    }

    public function user_update(Request $request, $id)
    {
        //validation rules
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:10', Rule::unique('users')->ignore($id)],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find($id);
        $user->fullName = $request->input('fullName');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');

        if ('' == !$request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Ce profil a été mis à jour avec succès.');
    }

    public function order_delete(Request $request, $id)
    {
        $order = ShoppingSession::find($id);
        $order->delete();

        return back()->with('success', 'Commande supprimée avec succès.');
    }

    public function order_view(Request $request, $id)
    {
        $order = ShoppingSession::find($id);

        $orderItems = $order->orderItems->all();

        return view('admin.order', compact('order'));
    }

    public function orderItem_view(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);

        return view('admin.orderItem', compact('orderItem'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param mixed $id
     *
     * @return Response
     */
    public function order_confirmed(Request $request, $id)
    {
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        try {
            $order = ShoppingSession::find($id);
        } catch (\Throwable $th) {
            dd($th);
        }
        $imageName = 'DZ'.$order->id.'-shipped-'.date('Y-m-d-H:i:s', time()).'.'.$request->proof_image->extension();

        // $image = $request->confirmation_image->storeAs('public/images/order-confirmationz', $imageName);

        $image = $request->file('proof_image');
        $filePath = 'public/images/proof_images/';
        $img = Image::make($image)->resize(920, 690, function ($const) {
            $const->aspectRatio();
        })->encode();

        if (Storage::disk('local')->exists($order->proofImage)) {
            Storage::disk('local')->delete($order->proofImage);
        }

        //Put file with own name
        Storage::put($imageName, $img);
        //Move file to your location
        Storage::move($imageName, 'public/images/proof_images/'.$imageName);

        $order->proofImage = $filePath.$imageName;
        $order->orderStatus = 'confirmed';

        $order->save();

        return redirect()->back()->with('success', 'Image uploaded and status changed!');
    }

    public function order_shipped(Request $request, $id)
    {
        $order = ShoppingSession::find($id);
        $order->orderStatus = 'shipped';
        // $order->trackingNumber = $request->input('tracking-number');
        $order->save();

        return redirect()->back()->with('success', 'Order Confirmed!');
    }

    public function order_delivered(Request $request, $id)
    {
        $order = ShoppingSession::find($id);
        $order->orderStatus = 'delivered';
        $order->save();

        return redirect()->back()->with('success', 'Order status changed to delivered :) ahssannnn');
    }

    public function searches()
    {
        $products = Products::orderBy('hits', 'desc')->paginate(12);

        return view('admin.searches', compact('products'));
    }

    public function searches_delete(Request $request, $id)
    {
        $product = Products::find($id);
        $product->delete();

        return back()->with('success', 'Produit supprimée avec succès.');
    }
}
