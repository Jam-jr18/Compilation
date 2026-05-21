@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-2xl p-8 border-t-8 border-purple-900">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-purple-900">Edit Guitar Record</h2>
        <a href="{{ route('guitars.index') }}" class="text-purple-600 hover:underline text-sm">← Back to List</a>
    </div>

    <form action="{{ route('guitars.update', $guitar->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT') <div>
            <label class="block text-purple-900 font-semibold mb-1">Brand</label>
            <input type="text" name="brand" value="{{ $guitar->brand }}" 
                   class="w-full border-2 border-purple-100 rounded-lg p-2 focus:border-purple-500 outline-none" required>
        </div>

        <div>
            <label class="block text-purple-900 font-semibold mb-1">Model</label>
            <input type="text" name="model" value="{{ $guitar->model }}" 
                   class="w-full border-2 border-purple-100 rounded-lg p-2 focus:border-purple-500 outline-none" required>
        </div>

        <div>
            <label class="block text-purple-900 font-semibold mb-1">Type</label>
            <select name="type" class="w-full border-2 border-purple-100 rounded-lg p-2 focus:border-purple-500 outline-none">
                <option value="Electric" {{ $guitar->type == 'Electric' ? 'selected' : '' }}>Electric</option>
                <option value="Acoustic" {{ $guitar->type == 'Acoustic' ? 'selected' : '' }}>Acoustic</option>
                <option value="Bass" {{ $guitar->type == 'Bass' ? 'selected' : '' }}>Bass</option>
                <option value="Classical" {{ $guitar->type == 'Classical' ? 'selected' : '' }}>Classical</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-purple-900 font-semibold mb-1">Year</label>
                <input type="number" name="year" value="{{ $guitar->year }}" 
                       class="w-full border-2 border-purple-100 rounded-lg p-2 focus:border-purple-500 outline-none" required>
            </div>
            <div>
    <label class="block text-purple-900 font-semibold mb-1">Price (₱)</label>
    <input type="number" step="0.01" name="price" value="{{ $guitar->price }}" 
           class="w-full border-2 border-purple-100 rounded-lg p-2 focus:border-purple-500 outline-none" required>
</div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-purple-900 text-white py-3 rounded-lg font-bold hover:bg-purple-800 transition shadow-lg">
                UPDATE
            </button>
        </div>
    </form>
</div>
@endsection