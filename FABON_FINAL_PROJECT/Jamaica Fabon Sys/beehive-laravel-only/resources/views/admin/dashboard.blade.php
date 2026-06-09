@extends('layout')
@section('title', 'beehive admin dashboard')
@push('head')
<style>
    .topbar,.footer{display:none!important}.wrap{width:100%!important;max-width:none!important;margin:0!important}.alert{margin:16px auto;width:min(1280px,92vw)}body{background:#f8fafc!important}.admin-shell{min-height:100vh;background:#f8fafc;color:#0b1d35}.admin-header{height:106px;background:#332d87;color:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 8.4vw;box-shadow:0 4px 20px rgba(15,23,42,.24)}.admin-brand{display:flex;align-items:center;gap:18px}.admin-icon{font-size:34px;color:#ffca28}.admin-brand h1{font-size:28px;line-height:1;margin:0;font-style:italic;font-weight:950;letter-spacing:-.05em}.admin-brand p{margin:4px 0 0;color:#d8d4ff;letter-spacing:.08em}.admin-actions{display:flex;gap:18px;align-items:center;flex-wrap:wrap}.period-tabs{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:4px;display:flex;gap:3px}.period-tabs a{font-size:13px;font-weight:950;text-transform:uppercase;color:#c8c3ff;padding:11px 17px;border-radius:13px}.period-tabs a.active{background:#09d449;color:#fff}.export-btn{background:#05c943;color:#fff;border-radius:15px;padding:14px 20px;font-weight:950}.admin-tabs{display:flex;background:rgba(255,255,255,.07);border-radius:15px;padding:4px;gap:4px}.admin-tabs a,.admin-tabs button{border:0;background:transparent;color:#fff;font-weight:950;border-radius:12px;padding:14px 26px;cursor:pointer}.admin-tabs a.active{background:#fff;color:#332d87}.admin-main{width:min(1400px,82vw);margin:28px auto 60px}.stats-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:24px;margin-bottom:32px}.stat-card{background:#fff;border:1px solid #e5e7eb;border-radius:26px;padding:28px 30px;display:flex;align-items:center;gap:20px;box-shadow:0 3px 10px rgba(15,23,42,.09)}.stat-icon{width:66px;height:66px;border-radius:18px;display:grid;place-items:center;font-size:31px}.stat-icon.green{background:#e8fff0;color:#16a34a}.stat-icon.blue{background:#eaf4ff;color:#2563eb}.stat-icon.purple{background:#faf0ff;color:#a21caf}.stat-icon.orange{background:#fff3e8;color:#fb5a14}.stat-label{font-size:16px;text-transform:uppercase;letter-spacing:.04em;color:#64748b;font-weight:800}.stat-value{font-size:30px;font-weight:950;letter-spacing:-.04em;margin-top:5px}.dashboard-grid{display:grid;grid-template-columns:1fr 2.1fr;gap:28px;margin-bottom:32px}.dashboard-grid.bottom{grid-template-columns:1fr 2.1fr}.analytics-card{background:#fff;border:1px solid #e5e7eb;border-radius:26px;box-shadow:0 3px 10px rgba(15,23,42,.08);min-height:245px;overflow:hidden}.analytics-card.large{min-height:245px}.card-head{display:flex;align-items:center;justify-content:space-between;padding:28px 32px;border-bottom:1px solid transparent}.card-head h2{font-size:22px;margin:0;font-weight:950;letter-spacing:-.03em}.soft-icon{width:46px;height:46px;border-radius:14px;background:#fff8df;color:#d28a00;display:grid;place-items:center;font-size:25px}.empty-state{display:grid;place-items:center;min-height:135px;color:#a9b3c4;font-size:18px;font-style:italic}.data-table{width:100%;border-collapse:collapse}.data-table th{background:#f8fafc;color:#64748b;text-align:left;font-size:12px;text-transform:uppercase;padding:18px 32px}.data-table td{padding:15px 32px;border-top:1px solid #f1f5f9}.split-row,.favorite-row,.category-row{display:flex;justify-content:space-between;align-items:center;padding:13px 32px;border-top:1px solid #f1f5f9}.split-row strong,.favorite-row strong,.category-row strong{font-weight:950}.mini-badge{border-radius:999px;padding:7px 10px;font-size:12px;font-weight:950;text-transform:uppercase}.mini-badge.pending{background:#fef3c7;color:#92400e}.mini-badge.preparing{background:#dbeafe;color:#1d4ed8}.mini-badge.ready{background:#dcfce7;color:#166534}.mini-badge.completed{background:#e5e7eb;color:#374151}.mini-badge.cancelled{background:#fee2e2;color:#991b1b}.mobile-logout{display:inline}
    @media(max-width:1150px){.admin-header{height:auto;padding:22px;align-items:flex-start;gap:18px;flex-direction:column}.admin-main{width:92vw}.stats-grid,.dashboard-grid,.dashboard-grid.bottom{grid-template-columns:1fr}.admin-actions{width:100%}.admin-tabs,.period-tabs{overflow:auto;max-width:100%}.admin-tabs a,.admin-tabs button{white-space:nowrap}.stat-card{padding:22px}.data-table{font-size:13px}.data-table th,.data-table td{padding:14px}}
</style>
@endpush
@section('content')
<div class="admin-shell">
    <header class="admin-header">
        <div class="admin-brand">
            <div class="admin-icon">▥</div>
            <div><h1>BeeHive Admin</h1><p>MANAGEMENT SUITE</p></div>
        </div>
        <div class="admin-actions">
            <div class="period-tabs">
                <a href="#">Daily</a><a href="#">Weekly</a><a href="#">Monthly</a><a href="#">Yearly</a><a class="active" href="#">All</a>
            </div>
            <a class="export-btn" href="{{ route('admin.reports.sales', ['period' => 'year']) }}">⇩ Export Sales</a>
            <nav class="admin-tabs">
                <a class="active" href="{{ route('admin.dashboard') }}">Analytics</a>
                <a href="{{ route('admin.menu') }}">Menu</a>
                <a href="{{ route('admin.tables') }}">Tables</a>
                <a href="{{ route('admin.settings') }}">Settings</a>
                <form method="POST" action="{{ route('logout', 'admin') }}">@csrf<button>Logout</button></form>
            </nav>
        </div>
    </header>

    <main class="admin-main">
        <section class="stats-grid">
            <article class="stat-card"><div class="stat-icon green">$</div><div><div class="stat-label">Today Sales</div><div class="stat-value">₱{{ number_format($sales['today'], 0) }}</div></div></article>
            <article class="stat-card"><div class="stat-icon blue">↗</div><div><div class="stat-label">Monthly Sales</div><div class="stat-value">₱{{ number_format($sales['month'], 0) }}</div></div></article>
            <article class="stat-card"><div class="stat-icon purple">▥</div><div><div class="stat-label">Yearly Sales</div><div class="stat-value">₱{{ number_format($sales['year'], 0) }}</div></div></article>
            <article class="stat-card"><div class="stat-icon orange">▣</div><div><div class="stat-label">Total Volume</div><div class="stat-value">{{ $counts['total_volume'] ?? $recentOrders->count() }}</div></div></article>
        </section>

        <section class="dashboard-grid">
            <article class="analytics-card">
                <div class="card-head"><h2>Today's Split</h2><span class="soft-icon">▦</span></div>
                @if(($counts['pending'] + $counts['preparing'] + $counts['ready'] + $counts['completed_today']) > 0)
                    <div class="split-row"><span>Pending</span><strong>{{ $counts['pending'] }}</strong></div>
                    <div class="split-row"><span>Preparing</span><strong>{{ $counts['preparing'] }}</strong></div>
                    <div class="split-row"><span>Ready</span><strong>{{ $counts['ready'] }}</strong></div>
                    <div class="split-row"><span>Completed</span><strong>{{ $counts['completed_today'] }}</strong></div>
                @else
                    <div class="empty-state">No sales today</div>
                @endif
            </article>

            <article class="analytics-card large">
                <div class="card-head"><h2>Sales Revenue Stream</h2><span style="color:#94a3b8;font-size:25px">♧</span></div>
                <table class="data-table">
                    <thead><tr><th>ID</th><th>Customer</th><th>Method</th><th>Status</th><th>Amount</th></tr></thead>
                    <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name ?: 'Guest' }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td><span class="mini-badge {{ $order->status }}">{{ $order->status }}</span></td>
                            <td><strong>₱{{ number_format($order->total, 0) }}</strong></td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><div class="empty-state">No orders yet</div></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </article>
        </section>

        <section class="dashboard-grid bottom">
            <article class="analytics-card">
                <div class="card-head"><h2>Top Favorites</h2><span style="color:#818cf8;font-size:25px">↗</span></div>
                @forelse($topItems as $item)
                    <div class="favorite-row"><span>{{ $item->item_name }} <small class="muted">x{{ $item->quantity }}</small></span><strong>₱{{ number_format($item->total, 0) }}</strong></div>
                @empty
                    <div class="empty-state">No data yet</div>
                @endforelse
            </article>

            <article class="analytics-card">
                <div class="card-head"><h2>Lifetime Revenue by Category</h2><span style="color:#94a3b8;font-size:25px">↗</span></div>
                @forelse($categorySales as $row)
                    <div class="category-row"><span>{{ $row->category }}</span><strong>₱{{ number_format($row->total, 0) }}</strong></div>
                @empty
                    <div class="empty-state">No category data yet.</div>
                @endforelse
            </article>
        </section>
    </main>
</div>
@endsection
