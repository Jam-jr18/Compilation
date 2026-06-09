@extends('layout')
@section('title', 'receipt '.$order->order_number)
@section('content')
<div class="receipt card">
    <div style="text-align:center">
        <div class="logo" style="margin:0 auto 12px">🐝</div>
        <h1 style="margin:0">{{ $business['name'] }}</h1>
        <p class="muted">{{ $business['tagline'] }}</p>
        <h2>Digital Receipt</h2>
    </div>

    <div class="receipt-line"><strong>Order No.</strong><span>{{ $order->order_number }}</span></div>
    <div class="receipt-line"><strong>Date</strong><span>{{ $order->created_at->format('M d, Y h:i A') }}</span></div>
    <div class="receipt-line"><strong>Type</strong><span>{{ str_replace('_', ' ', ucfirst($order->order_type)) }}</span></div>
    <div class="receipt-line"><strong>Table</strong><span>{{ $order->table?->name ?? 'N/A' }}</span></div>
    <div class="receipt-line"><strong>Status</strong><span class="badge {{ $order->status }}">{{ $order->status }}</span></div>
    <div class="receipt-line"><strong>Payment</strong><span>{{ ucfirst($order->payment_method) }} / {{ ucfirst($order->payment_status) }}</span></div>

    <h3>Items</h3>
    @foreach($order->items as $item)
        <div class="receipt-line">
            <span>{{ $item->item_name }} x{{ $item->quantity }}</span>
            <strong>₱{{ number_format($item->line_total, 2) }}</strong>
        </div>
    @endforeach
    <div class="receipt-line" style="font-size:22px"><strong>Total</strong><strong>₱{{ number_format($order->total, 2) }}</strong></div>

    @if($order->notes)<p><strong>Notes:</strong> {{ $order->notes }}</p>@endif

    <div class="actions no-print" style="justify-content:center;margin-top:22px">
        <button class="btn primary" onclick="window.print()">Print / Save PDF</button>
        <a class="btn honey" href="{{ route('orders.track', $order) }}">Track Order</a>
        <a class="btn ghost" href="{{ route('home') }}">New Order</a>
    </div>
</div>
@endsection
