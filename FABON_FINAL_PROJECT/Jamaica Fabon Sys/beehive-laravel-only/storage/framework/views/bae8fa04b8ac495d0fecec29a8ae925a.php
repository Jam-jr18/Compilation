<?php $__env->startSection('title', 'track order'); ?>
<?php $__env->startPush('head'); ?><?php if($order): ?><meta http-equiv="refresh" content="5"><?php endif; ?>@endpush
<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="card">
        <h1 style="font-size:48px">Track Order</h1>
        <form method="POST" action="<?php echo e(route('orders.track.redirect')); ?>" class="actions">
            <?php echo csrf_field(); ?>
            <input class="input" style="max-width:360px" name="order_number" value="<?php echo e($order?->order_number); ?>" placeholder="BEE-260524-ABC123">
            <button class="btn primary">Track</button>
        </form>
    </div>
</section>
<?php if($order): ?>
<section class="section">
    <div class="card">
        <div class="section-title">
            <div>
                <h2><?php echo e($order->order_number); ?></h2>
                <p class="muted">This page refreshes every 5 seconds.</p>
            </div>
            <span class="badge <?php echo e($order->status); ?>"><?php echo e($order->status); ?></span>
        </div>
        <?php ($steps = ['pending' => 'Pending', 'preparing' => 'Preparing', 'ready' => 'Ready!', 'completed' => 'Completed']); ?>
        <div class="status-steps">
            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="step <?php echo e(array_search($order->status, array_keys($steps), true) >= array_search($key, array_keys($steps), true) ? 'active' : ''); ?>"><?php echo e($label); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="grid two">
            <div>
                <h3>Order details</h3>
                <p><strong>Type:</strong> <?php echo e(str_replace('_', ' ', $order->order_type)); ?></p>
                <p><strong>Table:</strong> <?php echo e($order->table?->name ?? 'N/A'); ?></p>
                <p><strong>Total:</strong> ₱<?php echo e(number_format($order->total, 2)); ?></p>
            </div>
            <div>
                <h3>Items</h3>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><p><?php echo e($item->item_name); ?> x<?php echo e($item->quantity); ?></p><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/customer/track.blade.php ENDPATH**/ ?>