@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-[40px] shadow-2xl p-10 border border-slate-100 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-100 rounded-full blur-3xl"></div>

        <h2 class="text-3xl font-black text-slate-900 mb-8">Add New Instrument</h2>

        <form action="{{ route('guitars.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase ml-2">Brand</label>
                    <input type="text" name="brand" class="w-full bg-slate-50 border-2 border-transparent focus:border-purple-500 focus:bg-white rounded-2xl p-4 outline-none transition-all" placeholder="" required>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase ml-2">Model</label>
                    <input type="text" name="model" class="w-full bg-slate-50 border-2 border-transparent focus:border-purple-500 focus:bg-white rounded-2xl p-4 outline-none transition-all" placeholder="" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-400 uppercase ml-2">Category</label>
                <select name="type" class="w-full bg-slate-50 border-2 border-transparent focus:border-purple-500 focus:bg-white rounded-2xl p-4 outline-none transition-all appearance-none">
                    <option>Electric</option>
                    <option>Acoustic</option>
                    <option>Bass</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase ml-2">Production Year</label>
                    <input type="number" name="year" value="2024" class="w-full bg-slate-50 border-2 border-transparent focus:border-purple-500 focus:bg-white rounded-2xl p-4 outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase ml-2">Valuation (₱)</label>
                    <input type="number" step="0.01" name="price" class="w-full bg-slate-50 border-2 border-transparent focus:border-purple-500 focus:bg-white rounded-2xl p-4 outline-none transition-all" placeholder="0.00" required>
                </div>
            </div>

            <button type="submit" class="w-full purple-gradient text-white py-5 rounded-2xl font-black shadow-2xl hover:brightness-110 transform hover:scale-[1.02] transition-all uppercase tracking-widest">
                SAVE
            </button>
        </form>
    </div>
</div>
@endsection