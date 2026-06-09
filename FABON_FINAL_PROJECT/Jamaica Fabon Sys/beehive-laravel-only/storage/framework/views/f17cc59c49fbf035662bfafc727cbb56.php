<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'BeeHive Restobar'); ?></title>
    <?php echo $__env->yieldPushContent('head'); ?>
    <style>
        :root{--honey:#f59e0b;--amber:#d97706;--dark:#111827;--muted:#6b7280;--cream:#fff7ed;--line:#f3e4c7;--green:#16a34a;--red:#dc2626;--blue:#2563eb;}
        *{box-sizing:border-box} body{margin:0;font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:linear-gradient(135deg,#fff7ed,#fffbeb 40%,#fef3c7);color:var(--dark);min-height:100vh} a{color:inherit;text-decoration:none} img{max-width:100%}
        .wrap{width:min(1180px,92vw);margin:0 auto}.topbar{position:sticky;top:0;z-index:10;background:rgba(255,247,237,.88);backdrop-filter:blur(16px);border-bottom:1px solid var(--line)}.nav{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:15px 0}.brand{display:flex;align-items:center;gap:12px;font-weight:900;letter-spacing:-.03em}.logo{width:44px;height:44px;border-radius:16px;background:var(--dark);color:#fbbf24;display:grid;place-items:center;font-size:24px;box-shadow:0 10px 25px rgba(17,24,39,.14)}.links{display:flex;flex-wrap:wrap;gap:10px}.links a,.btn{border:0;border-radius:999px;padding:10px 15px;background:#fff;color:#111827;font-weight:800;box-shadow:0 8px 24px rgba(17,24,39,.07);cursor:pointer;display:inline-flex;align-items:center;gap:8px}.btn.primary{background:var(--dark);color:#fff}.btn.honey{background:var(--honey);color:#111827}.btn.green{background:var(--green);color:#fff}.btn.red{background:var(--red);color:#fff}.btn.blue{background:var(--blue);color:#fff}.btn.ghost{background:#fff7ed;border:1px solid var(--line);box-shadow:none}.hero{padding:44px 0 25px}.hero-grid{display:grid;grid-template-columns:1.4fr .6fr;gap:22px;align-items:stretch}.card{background:rgba(255,255,255,.86);border:1px solid var(--line);border-radius:28px;padding:22px;box-shadow:0 20px 60px rgba(120,53,15,.10)}.hero h1{font-size:clamp(38px,6vw,74px);line-height:.93;margin:0 0 16px;letter-spacing:-.06em}.subtitle{color:#92400e;font-weight:700;font-size:18px}.grid{display:grid;gap:18px}.grid.two{grid-template-columns:repeat(2,minmax(0,1fr))}.grid.three{grid-template-columns:repeat(3,minmax(0,1fr))}.grid.four{grid-template-columns:repeat(4,minmax(0,1fr))}.section{padding:22px 0}.section-title{display:flex;align-items:end;justify-content:space-between;gap:18px;margin:12px 0 16px}.section-title h2{font-size:30px;margin:0;letter-spacing:-.04em}.menu-card{overflow:hidden;padding:0}.menu-image{height:165px;width:100%;object-fit:cover;background:#fef3c7}.menu-body{padding:16px}.menu-body h3{margin:0 0 8px;font-size:20px}.price{font-weight:950;font-size:24px}.muted{color:var(--muted)}.small{font-size:13px}.field{display:grid;gap:7px;margin-bottom:12px}.field label{font-weight:800}.input,.select,.textarea{width:100%;border:1px solid var(--line);background:#fff;border-radius:16px;padding:12px 13px;font:inherit}.textarea{min-height:90px}.qty{width:82px;text-align:center}.alert{padding:14px 16px;border-radius:18px;margin:16px 0;font-weight:800}.alert.success{background:#dcfce7;color:#166534}.alert.error{background:#fee2e2;color:#991b1b}.table{width:100%;border-collapse:separate;border-spacing:0 10px}.table th{text-align:left;color:#92400e;font-size:13px;text-transform:uppercase;letter-spacing:.08em}.table td{background:#fff;padding:14px;border-top:1px solid var(--line);border-bottom:1px solid var(--line)}.table td:first-child{border-left:1px solid var(--line);border-radius:16px 0 0 16px}.table td:last-child{border-right:1px solid var(--line);border-radius:0 16px 16px 0}.badge{border-radius:999px;padding:7px 10px;font-size:12px;font-weight:900;text-transform:uppercase;display:inline-flex}.badge.pending{background:#fef3c7;color:#92400e}.badge.preparing{background:#dbeafe;color:#1d4ed8}.badge.ready{background:#dcfce7;color:#166534;animation:pulse 1.2s infinite}.badge.completed{background:#e5e7eb;color:#374151}.badge.cancelled{background:#fee2e2;color:#991b1b}.badge.available{background:#dcfce7;color:#166534}.badge.occupied{background:#fee2e2;color:#991b1b}.badge.reserved{background:#e0e7ff;color:#3730a3}@keyframes pulse{50%{transform:scale(1.05);box-shadow:0 0 0 8px rgba(22,163,74,.08)}}.receipt{max-width:760px;margin:32px auto}.receipt-line{display:flex;justify-content:space-between;gap:18px;padding:9px 0;border-bottom:1px dashed #e5c78b}.footer{padding:40px 0;color:#92400e}.portal-hotspot{position:fixed;top:0;left:0;width:34px;height:34px;z-index:99}.portal-hotspot a{opacity:0;display:block;width:100%;height:100%;background:#111827;border-radius:0 0 16px 0}.portal-hotspot:hover a{opacity:.95}.mobile-only{display:none}.actions{display:flex;gap:10px;flex-wrap:wrap;align-items:center}.mini{padding:7px 10px;border-radius:12px}.admin-nav{display:flex;gap:10px;flex-wrap:wrap;margin:16px 0}.danger-zone{border-color:#fecaca;background:#fff1f2}.stat{font-size:32px;font-weight:950;letter-spacing:-.04em}.status-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin:18px 0}.step{padding:14px;border-radius:18px;background:#fff;border:1px solid var(--line);font-weight:900;text-align:center;color:#9ca3af}.step.active{background:#111827;color:#fff}.qr{max-width:220px;border-radius:22px;background:#fff;padding:10px;border:1px solid var(--line)}
        @media(max-width:850px){.hero-grid,.grid.two,.grid.three,.grid.four{grid-template-columns:1fr}.links{display:none}.mobile-only{display:block}.table{font-size:14px}.table th{display:none}.table tr,.table td{display:block;width:100%}.table td{border-left:1px solid var(--line);border-right:1px solid var(--line);border-radius:0}.table td:first-child{border-radius:16px 16px 0 0}.table td:last-child{border-radius:0 0 16px 16px}.status-steps{grid-template-columns:1fr 1fr}}
        @media print{.topbar,.portal-hotspot,.no-print,.footer{display:none!important}body{background:#fff}.card{box-shadow:none}}
    </style>
</head>
<body>
    <div class="portal-hotspot no-print"><a href="<?php echo e(route('portal')); ?>" title="portal"></a></div>
    <header class="topbar no-print">
        <div class="wrap nav">
            <a class="brand" href="<?php echo e(route('home')); ?>"><span class="logo">🐝</span><span>BeeHive<br><small class="muted">Restobar System</small></span></a>
            <nav class="links">
                <a href="<?php echo e(route('home')); ?>">Order</a>
                <a href="<?php echo e(route('orders.track.form')); ?>">Track Order</a>
                <a href="<?php echo e(route('portal')); ?>">Staff / Admin</a>
            </nav>
            <a class="btn honey mobile-only" href="<?php echo e(route('portal')); ?>">portal</a>
        </div>
    </header>

    <main class="wrap">
        <?php if(session('success')): ?> <div class="alert success"><?php echo e(session('success')); ?></div> <?php endif; ?>
        <?php if(session('error')): ?> <div class="alert error"><?php echo e(session('error')); ?></div> <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert error">
                <strong>Please check the form:</strong>
                <ul style="margin:8px 0 0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer wrap no-print">BeeHive Restobar Laravel-only Order & Monitoring System</footer>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Jamaica Rose Fabon\Downloads\Jamaica Fabon Sys\beehive-laravel-only\resources\views/layout.blade.php ENDPATH**/ ?>