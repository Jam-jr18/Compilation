@extends('layout')
@section('title', 'beehive kitchen terminal')
@push('head')
<meta http-equiv="refresh" content="5">
<style>
    .topbar,.footer{display:none!important}.wrap{width:100%!important;max-width:none!important;margin:0!important}.alert{margin:16px auto;width:min(1200px,92vw)}body{background:#f8fafc!important}.staff-shell{min-height:100vh;background:#f8fafc;color:#172337}.kitchen-header{height:68px;background:#172337;color:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 12vw;box-shadow:0 4px 18px rgba(15,23,42,.22)}.kitchen-brand{display:flex;align-items:center;gap:14px;font-size:23px;font-weight:950;font-style:italic}.kitchen-brand span:first-child{font-size:30px;color:#f5b400}.active-count{font-weight:950}.active-dot{display:inline-block;width:9px;height:9px;border-radius:50%;background:#18c964;margin-right:8px}.kitchen-main{width:min(1460px,84vw);margin:24px auto 0;display:grid;grid-template-columns:minmax(0,1fr) 400px;gap:28px}.panel-title{display:flex;align-items:center;gap:10px;font-size:22px;font-weight:950;color:#334155;margin:0 0 28px}.empty-dashed{height:220px;border:2px dashed #94a3b8;border-radius:28px;display:grid;place-items:center;color:#94a3b8;font-size:18px;background:#fff}.order-card{background:#fff;border:1px solid #e2e8f0;border-radius:24px;padding:22px;margin-bottom:18px;box-shadow:0 8px 22px rgba(15,23,42,.07)}.order-top{display:flex;justify-content:space-between;gap:16px;align-items:flex-start;border-bottom:1px solid #e2e8f0;padding-bottom:16px;margin-bottom:16px}.order-num{font-size:24px;font-weight:950;margin:0}.order-meta{color:#64748b;margin:5px 0 0}.items-list{display:grid;gap:8px;margin:12px 0}.item-pill{background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:10px 12px;font-weight:800}.staff-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:16px}.history-panel{min-height:500px}.history-card{background:#fff;border:1px solid #e2e8f0;border-radius:20px;padding:16px;margin-bottom:12px;display:flex;justify-content:space-between;gap:12px}.history-card strong{color:#172337}.history-card span{color:#64748b;font-size:13px}.logout-btn{border:1px solid rgba(255,255,255,.25);background:rgba(255,255,255,.08);color:#fff;border-radius:999px;padding:10px 16px;font-weight:900;cursor:pointer}.badge{font-size:12px}.badge.pending{background:#fff7cc;color:#8a5b00}.badge.preparing{background:#dbeafe;color:#1d4ed8}.badge.ready{background:#dcfce7;color:#166534;animation:pulse 1.2s infinite}.badge.completed{background:#e5e7eb;color:#374151}.badge.cancelled{background:#fee2e2;color:#991b1b}
    @media(max-width:1050px){.kitchen-header{padding:0 22px}.kitchen-main{width:92vw;grid-template-columns:1fr}.history-panel{min-height:auto}}
</style>
@endpush
@section('content')
<div class="staff-shell">
    <header class="kitchen-header">
        <div class="kitchen-brand"><span>♨</span><span>BeeHive Kitchen Terminal</span></div>
        <div style="display:flex;align-items:center;gap:18px">
            <div class="active-count"><span class="active-dot"></span>{{ $orders->count() }} Active Orders</div>
            <form method="POST" action="{{ route('logout', 'staff') }}">@csrf<button class="logout-btn">Logout</button></form>
        </div>
    </header>

    <main class="kitchen-main">
        <section>
            <h2 class="panel-title">◷ Incoming & Preparation</h2>
            @forelse($orders as $order)
                <article class="order-card">
                    <div class="order-top">
                        <div>
                            <h3 class="order-num">{{ $order->order_number }}</h3>
                            <p class="order-meta">{{ $order->created_at->format('h:i A') }} • {{ str_replace('_', ' ', strtoupper($order->order_type)) }} • {{ $order->table?->name ?? 'No table' }}</p>
                        </div>
                        <span class="badge {{ $order->status }}">{{ $order->status }}</span>
                    </div>
                    <div class="items-list">
                        @foreach($order->items as $item)
                            <div class="item-pill"><strong>{{ $item->quantity }}x</strong> {{ $item->item_name }}</div>
                        @endforeach
                    </div>
                    @if($order->notes)<p><strong>Notes:</strong> {{ $order->notes }}</p>@endif
                    <p><strong>Total:</strong> ₱{{ number_format($order->total, 2) }} • <strong>Payment:</strong> {{ ucfirst($order->payment_method) }} / {{ ucfirst($order->payment_status) }}</p>
                    <div class="staff-actions">
                        @if($order->status === 'pending')
                            <form method="POST" action="{{ route('staff.orders.status', $order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="preparing"><button class="btn blue">Start Preparation</button></form>
                        @endif
                        @if(in_array($order->status, ['pending','preparing']))
                            <form method="POST" action="{{ route('staff.orders.status', $order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="ready"><button class="btn green">Set as Ready</button></form>
                        @endif
                        @if(in_array($order->status, ['pending','preparing','ready']))
                            <form method="POST" action="{{ route('staff.orders.status', $order) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="completed"><button class="btn primary">Completed</button></form>
                            <form method="POST" action="{{ route('staff.orders.status', $order) }}" onsubmit="return confirm('Cancel this order?')">@csrf @method('PATCH')<input type="hidden" name="status" value="cancelled"><button class="btn red">Cancel</button></form>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-dashed">No active orders.</div>
            @endforelse
        </section>
        <aside class="history-panel">
            <h2 class="panel-title">☑ Order History</h2>
            @forelse($completedToday as $order)
                <div class="history-card"><div><strong>{{ $order->order_number }}</strong><br><span>{{ $order->updated_at->format('h:i A') }}</span></div><strong>₱{{ number_format($order->total, 2) }}</strong></div>
            @empty
                <div class="empty-dashed" style="height:220px">No completed orders yet.</div>
            @endforelse
        </aside>
    </main>
</div>
@endsection
