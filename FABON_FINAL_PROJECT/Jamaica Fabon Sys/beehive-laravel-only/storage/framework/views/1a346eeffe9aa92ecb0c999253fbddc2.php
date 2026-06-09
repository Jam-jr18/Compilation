<?php $__env->startSection('title', 'settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-title"><div><h2>System Settings</h2><p class="muted">Update business info, GCash QR, and portal PINs.</p></div></div>
    <?php echo $__env->make('admin.partials-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" enctype="multipart/form-data" class="card">
        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
        <div class="grid two">
            <div>
                <h2>Business</h2>
                <div class="field"><label>Business name</label><input class="input" name="business_name" value="<?php echo e($settings['business_name']); ?>"></div>
                <div class="field"><label>Tagline</label><input class="input" name="business_tagline" value="<?php echo e($settings['business_tagline']); ?>"></div>
                <div class="field"><label>GCash account name</label><input class="input" name="gcash_name" value="<?php echo e($settings['gcash_name']); ?>"></div>
                <div class="field"><label>GCash number</label><input class="input" name="gcash_number" value="<?php echo e($settings['gcash_number']); ?>"></div>
                <div class="field"><label>Upload new GCash QR</label><input class="input" type="file" name="gcash_qr_image" accept="image/*"></div>
            </div>
            <div>
                <h2>Security</h2>
                <p class="muted">Leave blank if you do not want to change the PIN.</p>
                <div class="field"><label>New staff PIN</label><input class="input" type="password" name="staff_pin"></div>
                <div class="field"><label>New admin PIN</label><input class="input" type="password" name="admin_pin"></div>
                <?php if($settings['gcash_qr_base64']): ?>
                    <h3>Current QR</h3>
                    <img class="qr" src="<?php echo e($settings['gcash_qr_base64']); ?>" alt="Current QR">
                <?php endif; ?>
            </div>
        </div>
        <button class="btn primary">Save Settings</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/admin/settings.blade.php ENDPATH**/ ?>