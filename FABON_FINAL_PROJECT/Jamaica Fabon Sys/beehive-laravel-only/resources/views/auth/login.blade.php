@extends('layout')
@section('title', $role.' login')
@section('content')
<section class="hero">
    <div class="card" style="max-width:520px;margin:auto">
        <h1 style="font-size:42px">{{ ucfirst($role) }} Login</h1>
        <form method="POST" action="{{ route('login.attempt', $role) }}">
            @csrf
            <div class="field">
                <label>{{ ucfirst($role) }} PIN</label>
                <input class="input" type="password" name="pin" autofocus required placeholder="Enter PIN">
            </div>
            <button class="btn primary" style="width:100%;justify-content:center">Enter Portal</button>
        </form>
        <p class="small muted">Default {{ $role }} PIN: {{ $role === 'admin' ? 'admin123' : 'staff123' }}</p>
    </div>
</section>
@endsection
