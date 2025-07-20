<!DOCTYPE html>
<html>
<head>
    <title>Cart | Furniture Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <h1>Your Cart</h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php if(empty($cart)): ?>
        <div class="alert alert-warning">No items in cart.</div>
        <a href="/products" class="btn btn-primary">Shop Now</a>
    <?php else: ?>
    <form method="post" action="/cart/coupon" class="mb-3">
        <?php echo csrf_field(); ?>
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
        <?php $total = 0; ?>
        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
            <tr>
                <td>
                    <img src="<?php echo e(asset('images/'.$item['image'])); ?>" width="60" style="border-radius:6px;aspect-ratio:1/1;object-fit:cover;">
                </td>
                <td><?php echo e($item['name']); ?></td>
                <td>₹<?php echo e($item['price']); ?></td>
                <td>
                    <form method="POST" action="/cart/update/<?php echo e($id); ?>" style="display:inline-flex;">
                        <?php echo csrf_field(); ?>
                        <input type="number" name="qty" value="<?php echo e($item['qty']); ?>" min="1" style="width:60px;" class="form-control form-control-sm">
                        <button class="btn btn-sm btn-outline-secondary ms-2" type="submit">Update</button>
                    </form>
                </td>
                <td>₹<?php echo e($subtotal); ?></td>
                <td>
                    <a href="/cart/remove/<?php echo e($id); ?>" onclick="return confirm('Remove this item?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                <td class="fw-bold">₹<?php echo e($total); ?></td>
                <td>
                    <a href="/cart/clear" class="btn btn-sm btn-outline-danger" onclick="return confirm('Clear entire cart?')">Clear Cart</a>
                </td>
            </tr>
            <?php
                $discount = session('discount') ?? 0;
                $coupon = session('coupon') ?? '';
                $payable = $total - $discount;
            ?>
            <?php if($discount > 0): ?>
            <tr>
                <td colspan="4" class="text-end text-success">Coupon (<b><?php echo e($coupon); ?></b>) Discount:</td>
                <td class="text-success">-₹<?php echo e($discount); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Payable Amount:</td>
                <td class="fw-bold">₹<?php echo e($payable); ?></td>
                <td></td>
            </tr>
            <?php endif; ?>
        </tfoot>
    </table>
    <a href="/checkout" class="btn btn-success">Proceed to Checkout</a>
    <a href="/products" class="btn btn-secondary">Continue Shopping</a>
    <?php endif; ?>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\my-ecommerce\resources\views/cart.blade.php ENDPATH**/ ?>