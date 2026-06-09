<?php $__env->startSection('title', 'manage tables'); ?>
<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-title"><div><h2>Table Management</h2><p class="muted">Create tables and manage occupancy.</p></div></div>
    <?php echo $__env->make('admin.partials-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="card">
        <h2>Add table</h2>
        <form method="POST" action="<?php echo e(route('admin.tables.store')); ?>" class="actions">
            <?php echo csrf_field(); ?>
            <input class="input" style="max-width:260px" name="name" placeholder="Table name" required>
            <input class="input" style="max-width:140px" type="number" name="capacity" value="4" min="1" max="30" required>
            <button class="btn primary">Add Table</button>
        </form>
    </div>
</section>

<section class="section">
    <div class="card">
        <h2>Tables</h2>
        <table class="table">
            <thead><tr><th>Name</th><th>Capacity</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td colspan="4">
                            <form method="POST" action="<?php echo e(route('admin.tables.update', $table)); ?>" class="actions">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <input class="input" style="max-width:240px" name="name" value="<?php echo e($table->name); ?>">
                                <input class="input" style="max-width:100px" type="number" name="capacity" value="<?php echo e($table->capacity); ?>" min="1" max="30">
                                <select class="select" style="max-width:170px" name="status">
                                    <?php $__currentLoopData = ['available','occupied','reserved']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>" <?php if($table->status === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="badge <?php echo e($table->status); ?>"><?php echo e($table->status); ?></span>
                                <button class="btn blue mini">Save</button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.tables.delete', $table)); ?>" onsubmit="return confirm('Delete this table?')" style="margin-top:8px">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn red mini">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4">No tables yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/admin/tables.blade.php ENDPATH**/ ?>