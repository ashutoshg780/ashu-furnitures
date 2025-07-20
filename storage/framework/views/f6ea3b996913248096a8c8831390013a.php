<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Furniture Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    $cartCount = is_array(session('cart')) ? array_sum(array_column(session('cart'), 'qty')) : 0;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">Ashu Furnitures</a>
  </div>
</nav>
<div class="container mt-5">
    <h1>Checkout</h1>
    <?php if(empty($cart)): ?>
        <div class="alert alert-warning">Your cart is empty.</div>
        <a href="/products" class="btn btn-primary">Shop Now</a>
    <?php else: ?>
    <div class="row">
        <div class="col-md-7">
            <form method="POST" action="/checkout">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control" required pattern="[0-9]{10}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Delivery Address</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Place Order</button>
                <a href="/cart" class="btn btn-secondary">Back to Cart</a>
            </form>
        </div>
        <div class="col-md-5">
            <h4>Order Summary</h4>
            <ul class="list-group mb-3">
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?php echo e($item['name']); ?> <small>(x<?php echo e($item['qty']); ?>)</small></span>
                        <span>₹<?php echo e($item['price'] * $item['qty']); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="fw-bold">Subtotal</span>
                    <span>₹<?php echo e($total); ?></span>
                </li>
                <?php if($discount > 0): ?>
                <li class="list-group-item d-flex justify-content-between text-success">
                    <span>Coupon Discount</span>
                    <span>-₹<?php echo e($discount); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="fw-bold">Payable</span>
                    <span class="fw-bold">₹<?php echo e($payable); ?></span>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\my-ecommerce\resources\views/checkout.blade.php ENDPATH**/ ?>