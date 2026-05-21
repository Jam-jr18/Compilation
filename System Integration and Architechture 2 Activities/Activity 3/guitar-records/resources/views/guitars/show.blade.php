@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('guitars.index') }}" class="text-purple-700 hover:text-purple-900 font-semibold flex items-center gap-2">
            ← Back to Collection
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">
        <div class="bg-purple-900 p-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-300 uppercase tracking-widest text-sm font-bold">{{ $guitar->type }}</p>
                    <h2 class="text-4xl font-extrabold">{{ $guitar->brand }}</h2>
                    <h3 class="text-2xl text-purple-200">{{ $guitar->model }}</h3>
                </div>
                <div class="text-right">
                    <span class="text-xs bg-purple-700 px-3 py-1 rounded-full uppercase">ID: #{{ $guitar->id }}</span>
                </div>
            </div>
        </div>

        <div class="p-8 grid grid-cols-2 gap-8">
            <div class="space-y-1">
                <p class="text-gray-500 text-sm uppercase font-bold">Year of Manufacture</p>
                <p class="text-xl text-purple-900 font-semibold">{{ $guitar->year }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-gray-500 text-sm uppercase font-bold">Market Value</p>
                <p class="text-3xl text-purple-900 font-black">₱{{ number_format($guitar->price, 2) }}</p>
            </div>

            <div class="col-span-2 pt-6 border-t border-purple-50 flex gap-4">
                <a href="{{ route('guitars.edit', $guitar->id) }}" 
                   class="flex-1 bg-purple-600 text-white text-center py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg">
                    Edit Details
                </a>
                
                <form action="{{ route('guitars.destroy', $guitar->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this guitar from your records?')" 
                            class="w-full bg-white border-2 border-red-500 text-red-500 py-3 rounded-xl font-bold hover:bg-red-50 transition">
                        Remove Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection