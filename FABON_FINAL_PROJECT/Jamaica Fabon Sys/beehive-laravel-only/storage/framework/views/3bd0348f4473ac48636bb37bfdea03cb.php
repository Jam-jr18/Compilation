<?php $__env->startSection('title', 'staff and admin portal'); ?>
<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="card" style="text-align:center">
        <div class="logo" style="margin:0 auto 14px">🐝</div>
        <h1 style="font-size:48px">BeeHive Portal</h1>
        <p class="muted">Select the access area. Default codes are staff123 and admin123.</p>
        <div class="actions" style="justify-content:center;margin-top:22px">
            <a class="btn honey" href="<?php echo e(route('login.show', 'staff')); ?>">Staff Terminal</a>
            <a class="btn primary" href="<?php echo e(route('login.show', 'admin')); ?>">Management Dashboard</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/auth/portal.blade.php ENDPATH**/ ?>