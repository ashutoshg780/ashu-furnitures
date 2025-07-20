<!DOCTYPE html>
<html>
<head>
    <title>Ashu Furnitures | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { background: #f5f6fa; }
        .hero-img {
            width: 100%;
            max-height: 350px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 8px 24px #0002;
        }
        .ashu-brand {
            font-weight: bold;
            color: #0d6efd;
            font-size: 1.9rem;
            letter-spacing: 1px;
        }
        .furnitures-brand {
            font-weight: bold;
            color: #222;
            font-size: 1.9rem;
            letter-spacing: 1px;
        }
        /* --- Cart Icon & Badge --- */
        .cart-btn {
            font-size: 1.9rem;
            color: #0d6efd;
            padding: 0 0.5rem;
            display: inline-flex;
            align-items: center;
            height: 54px; /* match navbar height */
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
<!-- Navbar -->
@php
    $cartCount = is_array(session('cart')) ? array_sum(array_column(session('cart'), 'qty')) : 0;
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/" style="font-size:2rem; font-weight:bold; color:#222;">
       Ashu Furnitures
    </a>
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
    <div class="row align-items-center">
        <div class="col-md-7 mb-4 mb-md-0">
            <h1 class="display-4 fw-bold">
                Welcome to Ashu Furnitures
            </h1>
            <p class="lead">Discover quality furniture for your home & office. Stylish sofas, modern chairs, study tables, and more—all at affordable prices.</p>
            <a href="/products" class="btn btn-lg btn-success mt-2">Shop Now</a>
        </div>
        <div class="col-md-5 text-center">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner rounded-4 shadow-sm">
                <div class="carousel-item active">
                  <img src="{{ asset('images/chair.jpg') }}" class="d-block w-100 hero-img" alt="Modern Chair">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/sofa.jpg') }}" class="d-block w-100 hero-img" alt="Stylish Sofa">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/table.jpg') }}" class="d-block w-100 hero-img" alt="Dining Table">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/desk.jpg') }}" class="d-block w-100 hero-img" alt="Office Desk">
                </div>
                <!-- Add more product images as needed -->
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
              </button>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <h3 class="mb-4">Why Shop With Us?</h3>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-truck" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-2">Free Delivery</h5>
                    <p class="card-text">On all orders above ₹5,000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-2">Secure Payments</h5>
                    <p class="card-text">100% safe & secure transactions</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-star" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-2">Best Quality</h5>
                    <p class="card-text">Premium & durable furniture products</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>
</html>
