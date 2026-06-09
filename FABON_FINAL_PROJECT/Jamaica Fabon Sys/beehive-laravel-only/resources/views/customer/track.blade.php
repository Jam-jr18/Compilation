@extends('layout')
@section('title', 'track order')
@push('head')@if($order)<meta http-equiv="refresh" content="5">@endif@endpush
@section('content')
<section class="hero">
    <div class="card">
        <h1 style="font-size:48px">Track Order</h1>
        <form method="POST" action="{{ route('orders.track.redirect') }}" class="actions">
            @csrf
            <input class="input" style="max-width:360px" name="order_number" value="{{ $order?->order_number }}" placeholder="BEE-260524-ABC123">
            <button class="btn primary">Track</button>
        </form>
    </div>
</section>
@if($order)
<section class="section">
    <div class="card">
        <div class="section-title">
            <div>
                <h2>{{ $order->order_number }}</h2>
                <p class="muted">This page refreshes every 5 seconds.</p>
            </div>
            <span class="badge {{ $order->status }}">{{ $order->status }}</span>
        </div>
        @php($steps = ['pending' => 'Pending', 'preparing' => 'Preparing', 'ready' => 'Ready!', 'completed' => 'Completed'])
        <div class="status-steps">
            @foreach($steps as $key => $label)
                <div class="step {{ array_search($order->status, array_keys($steps), true) >= array_search($key, array_keys($steps), true) ? 'active' : '' }}">{{ $label }}</div>
            @endforeach
        </div>
        <div class="grid two">
            <div>
                <h3>Order details</h3>
                <p><strong>Type:</strong> {{ str_replace('_', ' ', $order->order_type) }}</p>
                <p><strong>Table:</strong> {{ $order->table?->name ?? 'N/A' }}</p>
                <p><strong>Total:</strong> ₱{{ number_format($order->total, 2) }}</p>
            </div>
            <div>
                <h3>Items</h3>
                @foreach($order->items as $item)<p>{{ $item->item_name }} x{{ $item->quantity }}</p>@endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endsection
