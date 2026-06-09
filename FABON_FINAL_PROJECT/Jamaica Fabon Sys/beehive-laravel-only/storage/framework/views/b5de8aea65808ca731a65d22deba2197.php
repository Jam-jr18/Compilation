<?php $__env->startSection('title', $role.' login'); ?>
<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="card" style="max-width:520px;margin:auto">
        <h1 style="font-size:42px"><?php echo e(ucfirst($role)); ?> Login</h1>
        <form method="POST" action="<?php echo e(route('login.attempt', $role)); ?>">
            <?php echo csrf_field(); ?>
            <div class="field">
                <label><?php echo e(ucfirst($role)); ?> PIN</label>
                <input class="input" type="password" name="pin" autofocus required placeholder="Enter PIN">
            </div>
            <button class="btn primary" style="width:100%;justify-content:center">Enter Portal</button>
        </form>
        <p class="small muted">Default <?php echo e($role); ?> PIN: <?php echo e($role === 'admin' ? 'admin123' : 'staff123'); ?></p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/auth/login.blade.php ENDPATH**/ ?>