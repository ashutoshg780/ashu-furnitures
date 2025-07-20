<!DOCTYPE html>
<html>
<head>
    <title>Products | Furniture Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style> 
        .product-img {
            width: 100%;
            aspect-ratio: 1 / 1;   /* This keeps your image square */
            object-fit: cover;
            border-radius: 8px;
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
    <h1 class="mb-4">Products</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($product->image)
                <img src="{{ asset('images/'.$product->image) }}" class="product-img" alt="{{ $product->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text fw-bold">₹{{ $product->price }}</p>
                    <a href="/product/{{ $product->id }}" class="btn btn-sm btn-outline-primary">View</a>
                    <a href="/cart/add/{{ $product->id }}" class="btn btn-sm btn-success">Add to Cart</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
</html>
