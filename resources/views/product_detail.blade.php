<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} | Furniture Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .product-img-big {
            width: 100%;
            max-width: 400px;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 12px;
            background: #f8f8f8;
        }
.cart-btn {
    font-size: 1.9rem;
    color: #0d6efd;
    padding: 0 0.5rem;
    display: inline-flex;
    align-items: center;
    height: 54px;
    position: relative;
    background: transparent;
    border: none;
    box-shadow: none;
}
.cart-btn:focus {
    outline: none;
    box-shadow: none;
}
.cart-badge {
    font-size: 0.75rem;
    position: absolute;
    top: 8px;
    right: 3px;
    transform: none;
    padding: 3px 7px;
    line-height: 1;
}
</style>
</head>
<body>
@php
    $cartCount = is_array(session('cart')) ? array_sum(array_column(session('cart'), 'qty')) : 0;
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">Ashu Furnitures</a>
    <div>
      @if(!Request::is('cart') && !Request::is('checkout'))
        <a href="/cart" class="cart-btn">
            <i class="bi bi-cart"></i>
            @if($cartCount > 0)
                <span class="cart-badge badge rounded-pill bg-danger">
                    {{ $cartCount }}
                </span>
            @endif
        </a>
      @endif
    </div>
  </div>
</nav>
<div class="container mt-5">
    <a href="/products" class="btn btn-secondary mb-4">&larr; Back to Products</a>
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('images/'.$product->image) }}" class="product-img-big mb-3" alt="{{ $product->name }}">
        </div>
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>
            <h3 class="text-success mb-3">₹{{ $product->price }}</h3>
            <p>{{ $product->description }}</p>
            <a href="/cart/add/{{ $product->id }}" class="btn btn-success">Add to Cart</a>
        </div>
    </div>
</div>
</body>
</html>
