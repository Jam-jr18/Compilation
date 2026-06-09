<?php $__env->startSection('title', 'manage menu'); ?>
<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="section-title"><div><h2>Menu Management</h2><p class="muted">Add, edit, delete categories and menu items.</p></div></div>
    <?php echo $__env->make('admin.partials-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="grid two">
        <div class="card">
            <h2>Add category</h2>
            <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="field"><label>Name</label><input class="input" name="name" required></div>
                <div class="field"><label>Sort order</label><input class="input" type="number" name="sort_order" value="0"></div>
                <button class="btn primary">Add Category</button>
            </form>
        </div>
        <div class="card">
            <h2>Add item</h2>
            <form method="POST" action="<?php echo e(route('admin.items.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="field"><label>Category</label><select class="select" name="menu_category_id" required><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
                <div class="field"><label>Name</label><input class="input" name="name" required></div>
                <div class="field"><label>Description</label><textarea class="textarea" name="description"></textarea></div>
                <div class="field"><label>Price</label><input class="input" type="number" step="0.01" min="1" name="price" required></div>
                <div class="field"><label>Image upload</label><input class="input" type="file" name="image_file" accept="image/*"></div>
                <label><input type="checkbox" name="is_available" value="1" checked> Available</label><br><br>
                <button class="btn primary">Add Item</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <h2>Categories</h2>
        <table class="table">
            <thead><tr><th>Name</th><th>Sort</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="3">
                        <form method="POST" action="<?php echo e(route('admin.categories.update', $category)); ?>" class="actions">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <input class="input" style="max-width:240px" name="name" value="<?php echo e($category->name); ?>">
                            <input class="input" style="max-width:100px" type="number" name="sort_order" value="<?php echo e($category->sort_order); ?>">
                            <button class="btn blue mini">Save</button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.categories.delete', $category)); ?>" onsubmit="return confirm('Delete this category? Items under it will also be deleted.')" style="margin-top:8px">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn red mini">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<section class="section">
    <div class="section-title"><h2>Menu items</h2></div>
    <div class="grid two">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <form method="POST" action="<?php echo e(route('admin.items.update', $item)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                    <div class="grid two">
                        <div>
                            <?php if($item->image_base64): ?><img src="<?php echo e($item->image_base64); ?>" style="height:150px;width:100%;object-fit:cover;border-radius:20px"><?php endif; ?>
                            <div class="field"><label>Replace image</label><input class="input" type="file" name="image_file" accept="image/*"></div>
                        </div>
                        <div>
                            <div class="field"><label>Category</label><select class="select" name="menu_category_id"><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if($item->menu_category_id === $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
                            <div class="field"><label>Name</label><input class="input" name="name" value="<?php echo e($item->name); ?>"></div>
                            <div class="field"><label>Price</label><input class="input" type="number" step="0.01" name="price" value="<?php echo e($item->price); ?>"></div>
                        </div>
                    </div>
                    <div class="field"><label>Description</label><textarea class="textarea" name="description"><?php echo e($item->description); ?></textarea></div>
                    <label><input type="checkbox" name="is_available" value="1" <?php if($item->is_available): echo 'checked'; endif; ?>> Available</label>
                    <div class="actions" style="margin-top:14px"><button class="btn blue">Save Item</button></div>
                </form>
                <form method="POST" action="<?php echo e(route('admin.items.delete', $item)); ?>" onsubmit="return confirm('Delete this item?')" style="margin-top:10px">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn red">Delete Item</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/admin/menu.blade.php ENDPATH**/ ?>