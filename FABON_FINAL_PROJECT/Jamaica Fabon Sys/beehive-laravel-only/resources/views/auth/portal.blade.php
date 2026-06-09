@extends('layout')
@section('title', 'staff and admin portal')
@section('content')
<section class="hero">
    <div class="card" style="text-align:center">
        <div class="logo" style="margin:0 auto 14px">🐝</div>
        <h1 style="font-size:48px">BeeHive Portal</h1>
        <p class="muted">Select the access area. Default codes are staff123 and admin123.</p>
        <div class="actions" style="justify-content:center;margin-top:22px">
            <a class="btn honey" href="{{ route('login.show', 'staff') }}">Staff Terminal</a>
            <a class="btn primary" href="{{ route('login.show', 'admin') }}">Management Dashboard</a>
        </div>
    </div>
</section>
@endsection
