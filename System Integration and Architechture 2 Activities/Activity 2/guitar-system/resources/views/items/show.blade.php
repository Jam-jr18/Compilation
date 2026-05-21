@extends('layouts.app')

@section('content')

<div class="detail-card" style="background:#f0e6fa; padding:20px; border-radius:15px;">

    <div class="row">

        <!-- LEFT -->
        <div class="col-md-4 text-center">
            <img src="{{ $item['artist_image'] }}" 
                 style="width:250px;height:250px;border-radius:50%;border:5px solid white;">
            
            <h3 class="mt-3">{{ $item['title'] }}</h3>
            <p>{{ $item['artist'] }}</p>
            <span class="badge badge-custom">{{ $item['difficulty'] }}</span>
        </div>

        <!-- RIGHT -->
        <div class="col-md-8">

            <h5>Chords</h5>
            <div class="chords-box mb-3 text-center" style="background:#d9c6f0;padding:10px;border-radius:8px;">
                <img src="{{ $item['chords_image'] }}" 
                     alt="Chords for {{ $item['title'] }}" 
                     style="max-width:100%; border-radius:8px;">
            </div>

            <h5>Lyrics with Chords</h5>
            <div class="chords-box mb-3" style="background:#d9c6f0;padding:10px;border-radius:8px;">
                <pre>{{ $item['lyrics_with_chords'] }}</pre>
            </div>

            <h5>Learn Here:</h5>
            <div class="mb-3">
                <a href="{{ $item['youtube_link'] }}" target="_blank" class="btn btn-success btn-lg">
                    ▶ Play on YouTube
                </a>
            </div>

            <div class="mt-3">
                <a href="/items" class="btn btn-back btn-secondary">← Back</a>
            </div>

        </div>

    </div>

</div>

@endsection