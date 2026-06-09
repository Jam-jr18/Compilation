<?php $__env->startSection('title', 'receipt '.$order->order_number); ?>
<?php $__env->startSection('content'); ?>
<div class="receipt card">
    <div style="text-align:center">
        <div class="logo" style="margin:0 auto 12px">🐝</div>
        <h1 style="margin:0"><?php echo e($business['name']); ?></h1>
        <p class="muted"><?php echo e($business['tagline']); ?></p>
        <h2>Digital Receipt</h2>
    </div>

    <div class="receipt-line"><strong>Order No.</strong><span><?php echo e($order->order_number); ?></span></div>
    <div class="receipt-line"><strong>Date</strong><span><?php echo e($order->created_at->format('M d, Y h:i A')); ?></span></div>
    <div class="receipt-line"><strong>Type</strong><span><?php echo e(str_replace('_', ' ', ucfirst($order->order_type))); ?></span></div>
    <div class="receipt-line"><strong>Table</strong><span><?php echo e($order->table?->name ?? 'N/A'); ?></span></div>
    <div class="receipt-line"><strong>Status</strong><span class="badge <?php echo e($order->status); ?>"><?php echo e($order->status); ?></span></div>
    <div class="receipt-line"><strong>Payment</strong><span><?php echo e(ucfirst($order->payment_method)); ?> / <?php echo e(ucfirst($order->payment_status)); ?></span></div>

    <h3>Items</h3>
    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="receipt-line">
            <span><?php echo e($item->item_name); ?> x<?php echo e($item->quantity); ?></span>
            <strong>₱<?php echo e(number_format($item->line_total, 2)); ?></strong>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="receipt-line" style="font-size:22px"><strong>Total</strong><strong>₱<?php echo e(number_format($order->total, 2)); ?></strong></div>

    <?php if($order->notes): ?><p><strong>Notes:</strong> <?php echo e($order->notes); ?></p><?php endif; ?>

    <div class="actions no-print" style="justify-content:center;margin-top:22px">
        <button class="btn primary" onclick="window.print()">Print / Save PDF</button>
        <a class="btn honey" href="<?php echo e(route('orders.track', $order)); ?>">Track Order</a>
        <a class="btn ghost" href="<?php echo e(route('home')); ?>">New Order</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/customer/receipt.blade.php ENDPATH**/ ?>