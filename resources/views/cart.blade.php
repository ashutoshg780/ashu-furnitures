<!DOCTYPE html>
<html>
<head>
    <title>Cart | Furniture Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    @php
    $cartCount = is_array(session('cart')) ? array_sum(array_column(session('cart'), 'qty')) : 0;
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">Ashu Furnitures</a>
  </div>
</nav>
<div class="container mt-5">
    <h1>Your Cart</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-warning">No items in cart.</div>
        <a href="/products" class="btn btn-primary">Shop Now</a>
    @else
    <form method="post" action="/cart/coupon" class="mb-3">
        @csrf
        <div class="row g-2 align-items-center">
            <div class="col-auto"><input type="text" name="coupon" placeholder="Enter Coupon Code" class="form-control" required></div>
            <div class="col-auto"><button type="submit" class="btn btn-outline-primary">Apply Coupon</button></div>
        </div>
    </form>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Image</th><th>Name</th><th>Price</th><th>Qty</th><th>Total</th><th>Remove</th>
            </tr>
        </thead>
        <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $id => $item)
            @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
            <tr>
                <td>
                    <img src="{{ asset('images/'.$item['image']) }}" width="60" style="border-radius:6px;aspect-ratio:1/1;object-fit:cover;">
                </td>
                <td>{{ $item['name'] }}</td>
                <td>₹{{ $item['price'] }}</td>
                <td>
                    <form method="POST" action="/cart/update/{{ $id }}" style="display:inline-flex;">
                        @csrf
                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" style="width:60px;" class="form-control form-control-sm">
                        <button class="btn btn-sm btn-outline-secondary ms-2" type="submit">Update</button>
                    </form>
                </td>
                <td>₹{{ $subtotal }}</td>
                <td>
                    <a href="/cart/remove/{{ $id }}" onclick="return confirm('Remove this item?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                <td class="fw-bold">₹{{ $total }}</td>
                <td>
                    <a href="/cart/clear" class="btn btn-sm btn-outline-danger" onclick="return confirm('Clear entire cart?')">Clear Cart</a>
                </td>
            </tr>
            @php
                $discount = session('discount') ?? 0;
                $coupon = session('coupon') ?? '';
                $payable = $total - $discount;
            @endphp
            @if($discount > 0)
            <tr>
                <td colspan="4" class="text-end text-success">Coupon (<b>{{ $coupon }}</b>) Discount:</td>
                <td class="text-success">-₹{{ $discount }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Payable Amount:</td>
                <td class="fw-bold">₹{{ $payable }}</td>
                <td></td>
            </tr>
            @endif
        </tfoot>
    </table>
    <a href="/checkout" class="btn btn-success">Proceed to Checkout</a>
    <a href="/products" class="btn btn-secondary">Continue Shopping</a>
    @endif
</div>
</body>
</html>
