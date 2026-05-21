@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div>
            <h2 class="text-4xl font-black text-slate-900">IF LIFE IS A GUITAR, YOU ARE THE TUNE.</h2>
            <p class="text-slate-500">"My guitar is not a thing. It is an extension of myself. It is who I am." — Joan Jett</p>
        </div>
        <a href="{{ route('guitars.create') }}" class="purple-gradient text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:scale-105 transition-transform">
            + Add New 
        </a>
    </div>

    <div class="bg-white rounded-[32px] shadow-2xl overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs uppercase tracking-widest">
                    <th class="py-6 px-8">Instrument Details</th>
                    <th class="py-6 px-4 text-center">Type</th>
                    <th class="py-6 px-4">Price</th>
                    <th class="py-6 px-8 text-right">Management</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($guitars as $guitar)
                <tr class="group hover:bg-purple-50/50 transition-colors">
                    <td class="py-6 px-8">
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-slate-900 group-hover:text-purple-700 transition-colors">{{ $guitar->brand }}</span>
                            <span class="text-sm text-slate-400">{{ $guitar->model }} ({{ $guitar->year }})</span>
                        </div>
                    </td>
                    <td class="py-6 px-4 text-center">
                        <span class="inline-block px-4 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold">{{ $guitar->type }}</span>
                    </td>
                    <td class="py-6 px-4">
                        <span class="text-xl font-black text-slate-900">₱{{ number_format($guitar->price, 2) }}</span>
                    </td>
                    <td class="py-6 px-8">
                        <div class="flex justify-end items-center gap-4">
                            <a href="{{ route('guitars.show', $guitar->id) }}" class="p-2 bg-slate-100 text-slate-600 rounded-xl hover:bg-purple-600 hover:text-white transition shadow-sm">View</a>
                            <a href="{{ route('guitars.edit', $guitar->id) }}" class="p-2 bg-slate-100 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">Edit</a>
                            <form action="{{ route('guitars.destroy', $guitar->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="p-2 bg-slate-100 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm" onclick="return confirm('Archive this record?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection