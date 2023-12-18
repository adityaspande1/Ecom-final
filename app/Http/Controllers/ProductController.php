<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

use Session;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    //
    function index()
    {
        $data= Product::all();

       return view('product',['products'=>$data]);
    }
    function detail($id)
    {
        $data =Product::find($id);
        return view('detail',['product'=>$data]);
    }
    function search(Request $req)
    {
        $data= Product::
        where('name', 'like', '%'.$req->input('query').'%')
        ->get();
        return view('search',['products'=>$data]);
    }
    function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
           $cart= new Cart;
           $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->save();
           return redirect('/');

        }
        else
        {
            return redirect('/login');
        }
    }
    static function cartItem()
    {
     $userId=Session::get('user')['id'];
     return Cart::where('user_id',$userId)->count();
    }
    public function cartList()
{
    if (!Session::has('user') || empty(Session::get('user')['id'])) {
        return redirect('/login')->with('error', 'Please log in to view your cart');
    }

    $userId = Session::get('user')['id'];

    $products = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->where('cart.user_id', $userId)
        ->select('products.*', 'cart.id as cart_id')
        ->get();

    return view('cartlist', ['products' => $products]);
}

    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    public function orderNow(Request $request)
    {
        $userId = null;
    
        if (Session::has('user') && !empty(Session::get('user')['id'])) {
            $userId = Session::get('user')['id'];
        }
    
        $total = 0;
        $products = [];
    
        if ($request->has('product_id')) {
            // Case: User clicked "Add to Cart"
            $product = Product::find($request->product_id);
            $total = $product->price;
            $products[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'category' => $product->category,
            ];
        } elseif ($userId) {
            // Case: User clicked "Buy Now" from the Cart
            $products = DB::table('cart')
                ->join('products', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', $userId)
                ->select('products.*', 'cart.id as cart_id')
                ->get();
    
            $total = $products->sum('price');
        }
    
        return view('ordernow', ['total' => $total, 'productDetails' => $products]);
    }
    

    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
         $allCart= Cart::where('user_id',$userId)->get();
         foreach($allCart as $cart)
         {
             $order= new Order;
             $order->product_id=$cart['product_id'];
             $order->user_id=$cart['user_id'];
             $order->status="pending";
             $order->payment_method=$req->payment;
             $order->payment_status="pending";
             $order->address=$req->address;
             $order->save();
             Cart::where('user_id',$userId)->delete(); 
         }
         $req->input();
         return redirect('/
         ');
        //  return redirect('/charge');
    }
    function myOrders()
    {
        $userId = null;

        if (Session::has('user') && !empty(Session::get('user')['id'])) {
            $userId = Session::get('user')['id'];
        }

        if ($userId) {
            $orders = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->where('orders.user_id', $userId)
                ->get();

            return view('myorders', ['orders' => $orders]);
        } else {
            // Handle the case when $userId is null
            return redirect('/login'); // or take any other appropriate action
        }
    }
}
