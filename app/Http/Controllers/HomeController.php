<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Products;
use App\Models\SubCategory;
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
     * Test endpoint.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test()
    {
        $mainCategories = MainCategory::all();

        return view('test', compact('mainCategories'));
    }

    //query cat and sub cat
    //if no mainCat get all products
    //if mainCat get all cat and products
    //if mainCat and and cat get all subCats and products
    //if mainCat, cat and subcat, get all

    public function products(Request $request)
    {
        if (!$request->mainCat) {
            $products = Products::orderBy('hits', 'desc')->paginate(50);

            return view('products')->with('products', $products)->with('mainCat', '')->with('categories', '')->with('subCategories', '');
        }
        if ($request->mainCat) {
            $mainCat = MainCategory::where('id', $request->mainCat)->first();
            $categories = Category::where('main_category_id', $request->mainCat)->get();
            if ($request->cat) {
                $subCategories = SubCategory::where('category_id', $request->cat)->get();
                if ($request->subCat) {
                    $products = Products::where('sub_category_id', $request->subCat)->paginate(50);

                    return view('products')->with('categories', $categories)->with('products', $products)->with('mainCat', $mainCat)->with('subCategories', $subCategories);
                }

                $products = Products::where('category_id', $request->cat)->paginate(50);

                return view('products')->with('categories', $categories)->with('products', $products)->with('mainCat', $mainCat)->with('subCategories', $subCategories);
            }
            $products = Products::where('main_category_id', $request->mainCat)->paginate(50);

            return view('products')->with('categories', $categories)->with('products', $products)->with('mainCat', $mainCat)->with('subCategories', '');
        }
    }

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
