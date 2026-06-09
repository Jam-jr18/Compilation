<?php $__env->startSection('title', $business['name'].' - order'); ?>
<?php $__env->startPush('head'); ?>
<style>
    .topbar,.footer{display:none!important}.wrap{width:100%!important;max-width:none!important;margin:0!important}.portal-hotspot a{background:#f6b400!important}.alert{position:fixed;left:24px;right:450px;top:90px;z-index:30}
    body{background:#fff7eb!important;overflow:hidden}.pos-shell{height:100vh;display:grid;grid-template-columns:minmax(0,1fr) 420px;background:#fff7eb;color:#0b1d35}.menu-pane{height:100vh;overflow:auto;padding-bottom:70px}.pos-header{height:78px;background:#f4b400;display:flex;align-items:center;justify-content:center;gap:16px;color:#fff;box-shadow:0 4px 18px rgba(15,23,42,.16);position:sticky;top:0;z-index:9}.brand-mark{width:48px;height:48px;border-radius:999px;background:#fff;color:#0f172a;display:grid;place-items:center;font-size:24px;font-weight:950;box-shadow:0 8px 20px rgba(0,0,0,.12)}.pos-header h1{margin:0;font-size:28px;font-style:italic;font-weight:950;letter-spacing:-.04em}.category-strip{position:sticky;top:78px;z-index:8;background:#fff;padding:18px 26px;border-bottom:1px solid #e5e7eb;box-shadow:0 4px 15px rgba(15,23,42,.06);display:flex;gap:14px;justify-content:center;flex-wrap:wrap}.cat-pill{border:0;border-radius:999px;background:#eef2f7;color:#64748b;font-weight:950;letter-spacing:.12em;text-transform:uppercase;padding:13px 30px;min-width:128px;text-align:center}.cat-pill.active,.cat-pill:hover{background:#f4b400;color:#fff;box-shadow:0 8px 16px rgba(244,180,0,.28)}.menu-content{padding:26px}.category-block{margin-bottom:62px}.category-title{display:grid;grid-template-columns:auto 1fr auto;gap:18px;align-items:center;margin:0 0 30px}.category-title h2{margin:0;font-size:30px;font-style:italic;font-weight:950;letter-spacing:-.05em}.category-line{height:2px;background:#dbe6f4}.option-badge{background:#eaf1f8;color:#7790b3;border-radius:999px;padding:8px 16px;font-size:14px;font-weight:900}.product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:30px}.product-card{background:#fff;border:1px solid #eadfcb;border-radius:18px;overflow:hidden;box-shadow:0 2px 8px rgba(15,23,42,.12);position:relative}.product-card img,.image-fallback{width:100%;height:224px;object-fit:cover;background:#f1c24b;display:grid;place-items:center;font-size:60px}.price-bubble{position:absolute;top:10px;right:12px;background:#f8fafc;color:#d28a00;border-radius:999px;padding:10px 18px;font-size:18px;font-weight:950;box-shadow:0 4px 12px rgba(15,23,42,.16)}.product-body{padding:24px 22px 20px}.product-body h3{font-size:25px;line-height:1.08;margin:0 0 10px;font-weight:950;color:#0b1d35}.product-body p{min-height:48px;margin:0 0 18px;color:#5d6b80;font-size:16px;line-height:1.45}.add-btn{width:100%;border:0;border-radius:12px;background:#f4b400;color:#fff;padding:17px 18px;font-size:18px;font-weight:950;display:flex;align-items:center;justify-content:center;gap:14px;cursor:pointer}.add-btn:hover{filter:brightness(.98);transform:translateY(-1px)}.cart-pane{height:100vh;background:#fff;border-left:1px solid #0f172a;display:flex;flex-direction:column;box-shadow:-8px 0 26px rgba(15,23,42,.08)}.cart-head{height:86px;background:#f4b400;color:#fff;display:flex;align-items:center;gap:14px;padding:0 28px}.cart-head h2{font-size:28px;font-style:italic;font-weight:950;margin:0;letter-spacing:-.05em}.order-tabs{padding:20px 22px 16px;border-bottom:1px solid #0f172a}.segmented{background:#fff;border-radius:24px;box-shadow:0 3px 10px rgba(15,23,42,.18);padding:7px;display:grid;grid-template-columns:1fr 1fr;gap:8px}.segmented button{border:0;border-radius:17px;padding:15px 12px;background:transparent;color:#93a3bd;font-weight:950;text-transform:uppercase;cursor:pointer}.segmented button.active{background:#ff5b0a;color:#fff;box-shadow:0 8px 16px rgba(255,91,10,.28)}.cart-scroll{flex:1;overflow:auto;padding:22px}.empty-cart{height:45vh;display:grid;place-items:center;text-align:center;color:#a0aabd;font-weight:800}.empty-cart .icon{font-size:82px;color:#e5e7eb;margin-bottom:14px}.cart-line{display:grid;grid-template-columns:1fr auto;gap:12px;padding:14px 0;border-bottom:1px dashed #e5e7eb}.cart-line h4{margin:0;font-size:16px}.cart-line .sub{color:#64748b;font-size:13px;margin-top:4px}.qty-controls{display:flex;gap:8px;align-items:center;justify-content:flex-end;margin-top:9px}.qty-controls button{width:30px;height:30px;border:0;border-radius:10px;background:#eef2f7;font-weight:950;cursor:pointer}.checkout-box{border-top:1px solid #e5e7eb;padding:20px 22px;background:#f8fafc}.checkout-box .field{margin-bottom:10px}.checkout-box label{font-size:13px;text-transform:uppercase;letter-spacing:.06em;color:#64748b}.checkout-box .input,.checkout-box .select,.checkout-box .textarea{border-radius:12px;padding:10px 11px}.total-row{display:flex;justify-content:space-between;align-items:center;font-weight:950;font-size:24px;margin:10px 0 14px}.submit-order{width:100%;border:0;border-radius:16px;background:#0f172a;color:#fff;font-weight:950;font-size:17px;padding:16px;cursor:pointer}.submit-order:disabled{background:#cbd5e1;cursor:not-allowed}.qr-mini{max-width:120px;border-radius:14px;border:1px solid #e5e7eb;background:#fff;padding:6px}.cart-empty-form{display:none!important}
    @media(max-width:1100px){body{overflow:auto}.pos-shell{height:auto;display:block}.menu-pane{height:auto;overflow:visible}.cart-pane{height:auto;min-height:80vh;border-left:0;border-top:1px solid #0f172a}.alert{right:24px}.product-grid{grid-template-columns:1fr}.category-strip{justify-content:flex-start;overflow:auto;flex-wrap:nowrap}.cat-pill{min-width:max-content}.pos-header{justify-content:flex-start;padding-left:22px}}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $allItems = $categories->flatMap(fn($category) => $category->items)->values();
?>
<form method="POST" action="<?php echo e(route('orders.store')); ?>" id="orderForm" class="pos-shell">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="order_type" id="orderType" value="<?php echo e(old('order_type', 'dine_in')); ?>">

    <section class="menu-pane">
        <header class="pos-header">
            <div class="brand-mark">🐝</div>
            <h1><?php echo e($business['name']); ?></h1>
        </header>

        <nav class="category-strip">
            <a href="#all" class="cat-pill active">All</a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#cat-<?php echo e($category->id); ?>" class="cat-pill"><?php echo e($category->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

        <div class="menu-content" id="all">
            <?php $__currentLoopData = $allItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" class="qty-input" data-item-id="<?php echo e($item->id); ?>" name="quantities[<?php echo e($item->id); ?>]" value="<?php echo e(old('quantities.'.$item->id, 0)); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section class="category-block" id="cat-<?php echo e($category->id); ?>">
                    <div class="category-title">
                        <h2><?php echo e(strtoupper($category->name)); ?></h2>
                        <span class="category-line"></span>
                        <span class="option-badge"><?php echo e($category->items->count()); ?> Options</span>
                    </div>
                    <div class="product-grid">
                        <?php $__empty_1 = true; $__currentLoopData = $category->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <article class="product-card">
                                <span class="price-bubble">₱<?php echo e(number_format($item->price, 0)); ?></span>
                                <?php if($item->image_base64): ?>
                                    <img src="<?php echo e($item->image_base64); ?>" alt="<?php echo e($item->name); ?>">
                                <?php else: ?>
                                    <div class="image-fallback">🐝</div>
                                <?php endif; ?>
                                <div class="product-body">
                                    <h3><?php echo e($item->name); ?></h3>
                                    <p><?php echo e($item->description); ?></p>
                                    <button type="button" class="add-btn" data-add="<?php echo e($item->id); ?>"><span style="font-size:28px;line-height:0">+</span> Add to Order</button>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="muted">No items available in this category.</p>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <aside class="cart-pane">
        <div class="cart-head">
            <span style="font-size:30px">🛒</span>
            <h2>YOUR SWARM ORDER</h2>
        </div>
        <div class="order-tabs">
            <div class="segmented">
                <button type="button" data-order="dine_in" class="active">🍴 Dine-in</button>
                <button type="button" data-order="take_out">🛍 Take-out</button>
            </div>
        </div>
        <div class="cart-scroll" id="cartItems">
            <div class="empty-cart"><div><div class="icon">🛒</div><p>Your hive is empty!</p></div></div>
        </div>
        <div class="checkout-box" id="checkoutBox" style="display:none">
            <div class="field">
                <label>Customer name</label>
                <input class="input" name="customer_name" value="<?php echo e(old('customer_name')); ?>" placeholder="optional">
            </div>
            <div class="field" id="tableField">
                <label>Available table</label>
                <select class="select" name="restaurant_table_id">
                    <option value="">Select table</option>
                    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($table->id); ?>" <?php if(old('restaurant_table_id') == $table->id): echo 'selected'; endif; ?>><?php echo e($table->name); ?> • <?php echo e($table->capacity); ?> pax</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="field">
                <label>Payment method</label>
                <select class="select" name="payment_method" id="paymentMethod">
                    <option value="cash" <?php if(old('payment_method', 'cash') === 'cash'): echo 'selected'; endif; ?>>Cash</option>
                    <option value="ewallet" <?php if(old('payment_method') === 'ewallet'): echo 'selected'; endif; ?>>GCash / E-wallet</option>
                </select>
            </div>
            <div id="ewalletFields" style="display:none">
                <?php if($business['gcash_qr_base64']): ?>
                    <img class="qr-mini" src="<?php echo e($business['gcash_qr_base64']); ?>" alt="GCash QR">
                <?php endif; ?>
                <div class="field">
                    <label>Sender name</label>
                    <input class="input" name="payment_sender_name" value="<?php echo e(old('payment_sender_name')); ?>">
                </div>
                <div class="field">
                    <label>Reference number</label>
                    <input class="input" name="payment_reference" value="<?php echo e(old('payment_reference')); ?>">
                </div>
            </div>
            <div class="field">
                <label>Notes</label>
                <textarea class="textarea" name="notes" placeholder="optional request"><?php echo e(old('notes')); ?></textarea>
            </div>
            <div class="total-row"><span>Total</span><span id="cartTotal">₱0</span></div>
            <button class="submit-order" id="submitBtn" disabled>Submit Order</button>
        </div>
    </aside>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
const menuItems = <?php echo json_encode($allItems->mapWithKeys(fn($item) => [$item->id => ['name' => $item->name, 'price' => (float) $item->price]])->toArray(), 512) ?>;
const quantities = {};
for (const id of Object.keys(menuItems)) quantities[id] = parseInt(document.querySelector(`[data-item-id="${id}"]`)?.value || '0', 10);
const peso = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', maximumFractionDigits: 0 });
function setQty(id, value){ quantities[id] = Math.max(0, value); const input = document.querySelector(`[data-item-id="${id}"]`); if(input) input.value = quantities[id]; renderCart(); }
function renderCart(){
    const cart = document.getElementById('cartItems');
    const rows = Object.entries(quantities).filter(([id, qty]) => qty > 0);
    let total = 0;
    if(rows.length === 0){
        cart.innerHTML = `<div class="empty-cart"><div><div class="icon">🛒</div><p>Your hive is empty!</p></div></div>`;
        document.getElementById('checkoutBox').style.display = 'none';
        document.getElementById('submitBtn').disabled = true;
    } else {
        cart.innerHTML = rows.map(([id, qty]) => {
            const item = menuItems[id]; const line = item.price * qty; total += line;
            return `<div class="cart-line"><div><h4>${item.name}</h4><div class="sub">${peso.format(item.price)} each</div><div class="qty-controls"><button type="button" onclick="setQty('${id}', ${qty - 1})">−</button><strong>${qty}</strong><button type="button" onclick="setQty('${id}', ${qty + 1})">+</button></div></div><strong>${peso.format(line)}</strong></div>`;
        }).join('');
        document.getElementById('checkoutBox').style.display = 'block';
        document.getElementById('submitBtn').disabled = false;
    }
    document.getElementById('cartTotal').textContent = peso.format(total);
}
document.querySelectorAll('[data-add]').forEach(button => button.addEventListener('click', () => setQty(button.dataset.add, (quantities[button.dataset.add] || 0) + 1)));
document.querySelectorAll('[data-order]').forEach(button => button.addEventListener('click', () => { document.querySelectorAll('[data-order]').forEach(b => b.classList.remove('active')); button.classList.add('active'); document.getElementById('orderType').value = button.dataset.order; toggleCheckoutFields(); }));
function toggleCheckoutFields(){
    const type = document.getElementById('orderType').value;
    const pay = document.getElementById('paymentMethod').value;
    document.querySelectorAll('[data-order]').forEach(button => button.classList.toggle('active', button.dataset.order === type));
    document.getElementById('tableField').style.display = type === 'dine_in' ? 'grid' : 'none';
    document.getElementById('ewalletFields').style.display = pay === 'ewallet' ? 'block' : 'none';
}
document.getElementById('paymentMethod').addEventListener('change', toggleCheckoutFields);
toggleCheckoutFields(); renderCart();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/customer/index.blade.php ENDPATH**/ ?>