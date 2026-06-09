<div class="admin-nav no-print">
    <a class="btn ghost" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
    <a class="btn ghost" href="<?php echo e(route('admin.menu')); ?>">Menu</a>
    <a class="btn ghost" href="<?php echo e(route('admin.tables')); ?>">Tables</a>
    <a class="btn ghost" href="<?php echo e(route('admin.settings')); ?>">Settings</a>
    <a class="btn honey" href="<?php echo e(route('staff.orders')); ?>">Staff Terminal</a>
    <form method="POST" action="<?php echo e(route('logout', 'admin')); ?>"><?php echo csrf_field(); ?><button class="btn red">Logout</button></form>
</div>
<?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/admin/partials-nav.blade.php ENDPATH**/ ?>