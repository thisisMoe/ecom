<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function tracking(Request $request)
    {
        if ('' != $request->trackingNumber) {
            $client = new Client();
            // $res = $client->request('POST', 'https://api.tracktry.com/v1/trackings/realtime', [
            //     'headers' => [
            //         'Content-Type' => 'application/json',
            //         'Accept' => 'application/json',
            //         'Tracktry-Api-Key' => '31e50fb8-e78a-4d42-8e8c-03b10935f063',
            //     ],
            //     'form_params' => [
            //         'tracking_number' => $request->trackingNumber,
            //     ],
            // ]);
            $res = $client->post(
                'https://api.tracktry.com/v1/trackings/realtime',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        'Tracktry-Api-Key' => '31e50fb8-e78a-4d42-8e8c-03b10935f063',
                    ],
                    'json' => [
                        'tracking_number' => $request->trackingNumber,
                        'carrier_code' => 'cainiao',
                    ],
                ]
            );
            // echo $res->getStatusCode(); // 200
            // echo $res->getBody(); // { "type": "User", ....
            // dd($res->getStatusCode());
            // dd(json_decode($res->getBody()));

            $response = json_decode($res->getBody(), true);
        } else {
            $response = '';
        }

        return view('tracking', compact('response'));
    }

    public function account(Request $request)
    {
        $user = User::find(Auth::user())->first();

        // if (!$request->exists('status')) {
        //     $orders = $user->inactiveShoppingSessions;
        // }

        switch ($request->status) {
            case 'pending':
                $orders = $user->inactiveShoppingSessions->where('orderStatus', 'pending')->sortByDesc('created_at');

                break;

            case 'confirmed':
                $orders = $user->inactiveShoppingSessions->where('orderStatus', 'confirmed')->sortByDesc('created_at');

                break;

            case 'shipped':
                $orders = $user->inactiveShoppingSessions->where('orderStatus', 'shipped')->sortByDesc('created_at');

                break;

            case 'delivered':
                $orders = $user->inactiveShoppingSessions->where('orderStatus', 'delivered')->sortByDesc('created_at');

                break;

            default:
                $orders = $user->inactiveShoppingSessions->sortByDesc('created_at');

                break;
        }

        return view('account')->with([
            'orders' => $orders,
        ]);
    }

    public function faq()
    {
        return view('faq');
    }

    public function about_us()
    {
        return view('about-us');
    }

    public function panier(Request $request)
    {
        $user = Auth::user();
        $activeShoppingSession = $user->shoppingSessions->where('status', 'Active')->first();

        if (!$activeShoppingSession) {
            $shoppingSession = $user->shoppingSessions()->create();
            $orderItems = [];
        } else {
            $orderItems = $activeShoppingSession->orderItems;
        }

        return view('user.panier', compact('orderItems'));
    }

    public function delete_OrderItem(Request $request, $id)
    {
        $user = Auth::user();
        $orderItem = $user->orderItems->where('id', $id)->first;
        $orderItem->delete();

        return redirect()->back()->with('success', 'Produit supprimé du panier');
    }

    public function addOrder(Request $request)
    {
        $user = Auth::user();
        $activeShoppingSession = $user->shoppingSessions->where('status', 'Active')->first();

        $order = $activeShoppingSession->order()->create([
            'user_id' => $user->id,
            'shopping_session_id' => $activeShoppingSession->id,
        ]);

        $activeShoppingSession->update([
            'status' => 'Inactive',
        ]);

        return redirect()->back()->with('success', 'Nous avons reçu votre commande avec succès.');
    }

    public function contact(Request $request)
    {
        return view('contact');
    }

    public function signin(Request $request)
    {
        return view('signin');
    }

    public function signup(Request $request)
    {
        return view('signup');
    }
}
