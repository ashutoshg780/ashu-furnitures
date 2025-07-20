<?php

use App\Models\Product;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Product List
Route::get('/products', function () {
    $products = Product::all();
    return view('products', ['products' => $products]);
});

// Product Detail
Route::get('/product/{id}', function($id) {
    $product = Product::findOrFail($id);
    return view('product_detail', ['product' => $product]);
});

/// Cart Page
Route::get('/cart', function(Request $request) {
    $cart = session()->get('cart', []);
    return view('cart', ['cart' => $cart]);
});

// Add to Cart (from product detail or listing)
Route::get('/cart/add/{id}', function($id) {
    $cart = session()->get('cart', []);
    if(isset($cart[$id])) {
        $cart[$id]['qty'] += 1;
    } else {
        $product = \App\Models\Product::findOrFail($id);
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "qty" => 1,
            "image" => $product->image
        ];
    }
    session()->put('cart', $cart);
    return redirect('/cart');
});


// Checkout
Route::get('/checkout', function() {
    $cart = session()->get('cart', []);
    return view('checkout', ['cart' => $cart]);
});
Route::post('/checkout', function(Request $request) {
    // Here, just clear cart and show "order placed" message
    session()->forget('cart');
    return redirect('/')->with('success', 'Order placed successfully!');
});

Route::get('/cart/clear', function() {
    session()->forget('cart');
    return redirect('/cart');
});


// Update cart item quantity
Route::post('/cart/update/{id}', function(Request $request, $id) {
    $cart = session()->get('cart', []);
    if(isset($cart[$id])) {
        $cart[$id]['qty'] = max(1, intval($request->input('qty')));
        session()->put('cart', $cart);
    }
    return redirect('/cart');
});

// Remove single item from cart
Route::get('/cart/remove/{id}', function($id) {
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
    return redirect('/cart');
});

// Clear the cart
Route::get('/cart/clear', function() {
    session()->forget('cart');
    session()->forget('discount');
    session()->forget('coupon');
    return redirect('/cart');
});

// Apply coupon
Route::post('/cart/coupon', function(Request $request) {
    $coupon = $request->input('coupon');
    $discount = 0;
    // Demo: If coupon == "DISCOUNT50", discount ₹50
    if (strtolower($coupon) == "discount50") {
        $discount = 50;
        session()->put('coupon', $coupon);
        session()->put('discount', $discount);
        return redirect('/cart')->with('success', 'Coupon applied! ₹50 off');
    } else {
        session()->forget('discount');
        session()->forget('coupon');
        return redirect('/cart')->with('error', 'Invalid coupon code');
    }
});


// Show checkout page
Route::get('/checkout', function() {
    $cart = session()->get('cart', []);
    $discount = session('discount') ?? 0;
    $coupon = session('coupon') ?? '';
    $total = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));
    $payable = $total - $discount;
    return view('checkout', compact('cart', 'total', 'discount', 'payable', 'coupon'));
});

// Process checkout
Route::post('/checkout', function(Request $request) {
    // Here, just clear cart and show "order placed" message
    session()->forget('cart');
    session()->forget('discount');
    session()->forget('coupon');
    return redirect('/')->with('success', 'Order placed successfully!');
});
