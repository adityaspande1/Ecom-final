<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});


Route::get('/register', [UserController::class, 'showRegistrationForm']);

Route::post('/register', [UserController::class, 'register']);

Route::post("/login",[UserController::class,'login']);
Route::get("/",[ProductController::class,'index']);
Route::get("detail/{id}",[ProductController::class,'detail']);
Route::get("search",[ProductController::class,'search']);
Route::post("add_to_cart",[ProductController::class,'addToCart']);
Route::get("cartlist",[ProductController::class,'cartList']); 
Route::get("removecart/{id}",[ProductController::class,'removeCart']); 
Route::get("ordernow",[ProductController::class,'orderNow']); 
Route::post("ordernow",[ProductController::class,'orderNow']); 
Route::post("orderplace",[ProductController::class,'orderPlace']);
Route::get("myorders",[ProductController::class,'myOrders']);
 

Route::get('/charge', function () {
    return view('charge');
});


Route::post('/charge', function (Request $request) {
    // Set your Stripe API key.
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    // Get the payment amount and email address from the form.
    $amount = $request->input('amount') * 100;
    $email = $request->input('email');

    // Create a new Stripe customer.
    $customer = \Stripe\Customer::create([
        'email' => $email,
        'source' => $request->input('stripeToken'),
    ]);
    
    // Create a new Stripe charge.
    $charge = \Stripe\Charge::create([
        'customer' => $customer->id,
        'amount' => $amount,
        'currency' => 'usd',
    ]);

    // Display a success message to the user.
    return 'Payment successful!';
});
