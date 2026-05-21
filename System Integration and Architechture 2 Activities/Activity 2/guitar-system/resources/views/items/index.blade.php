@extends('layouts.app')

@section('content')

<div class="hero">
    <h1> Discover Guitar Music</h1>
    <p>Play songs, view chords, and enjoy music </p>

    <form method="GET" action="/items">
        <input type="text" name="search" class="search-box" placeholder="Search songs..." autocomplete="off">
    </form>
</div>

@if(request('search'))
    <div class="text-center mt-3">
        <a href="/items" class="btn btn-back">← Back</a>
    </div>
@endif

<div class="row mt-4">
@foreach($items as $item)
    <div class="col-md-4 mb-4">
        <div class="song-card text-center" onclick="location.href='/items/{{ $item['id'] }}'">
            
            <img src="{{ $item['artist_image'] }}" class="artist-img mb-3">

            <h5>{{ $item['title'] }}</h5>
            <p class="text-muted">{{ $item['artist'] }}</p>

            <span class="badge badge-custom">{{ $item['difficulty'] }}</span>

            <!-- Play Icon -->
            <div class="play-btn">▶</div>

        </div>
    </div>
@endforeach
</div>

@endsection