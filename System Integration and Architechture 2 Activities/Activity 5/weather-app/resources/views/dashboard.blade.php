<x-app-layout>
    <div class="min-h-screen font-sans antialiased text-slate-200 selection:bg-purple-500/30" 
         style="background: radial-gradient(circle at top left, #2d1b4e, #1a1033, #0a0518);">
        
        <!-- Glassmorphic Header -->
        <nav class="border-b border-white/5 bg-black/20 backdrop-blur-2xl sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 bg-gradient-to-tr from-purple-600 to-indigo-600 rounded-2xl rotate-3 flex items-center justify-center shadow-[0_0_20px_rgba(147,51,234,0.3)]">
                        <svg class="w-7 h-7 text-white -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h1 class="font-extrabold text-2xl tracking-tight">Weather<span class="text-purple-400">OS</span></h1>
                        <p class="text-[10px] text-purple-300/50 uppercase tracking-[0.3em] font-bold">Project Core v2.0</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold leading-none">{{ Auth::user()->full_name }}</p>
                        <p class="text-[10px] text-purple-400 uppercase font-black mt-1 tracking-widest">{{ Auth::user()->role }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center font-bold text-purple-400">
                        {{ substr(Auth::user()->full_name, 0, 1) }}
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12 px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    
                    <!-- Environment & Telemetry Console -->
                    <div class="lg:col-span-8 space-y-10">
                        
                        <!-- Hero Environment Card -->
                        <div class="relative bg-white/[0.03] border border-white/10 rounded-[3.5rem] p-12 backdrop-blur-3xl shadow-2xl overflow-hidden">
                            <div class="absolute -top-24 -left-24 w-64 h-64 bg-purple-600/20 blur-[100px] rounded-full"></div>
                            
                            <div class="relative z-10">
                                <div class="flex justify-between items-center mb-12">
                                    <span class="px-4 py-1.5 bg-purple-500/10 border border-purple-500/20 rounded-full text-[10px] font-black text-purple-400 uppercase tracking-widest">
                                        {{ $weather['name'] ?? 'Local Intel' }}
                                    </span>
                                    <span class="text-sm font-mono text-slate-500 uppercase">{{ now()->format('D, M d') }}</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-16">
                                    <div class="flex items-start">
                                        <h2 class="text-[140px] font-thin leading-none tracking-tighter bg-gradient-to-b from-white to-white/20 bg-clip-text text-transparent">
                                            {{ round($weather['main']['temp'] ?? 0) }}
                                        </h2>
                                        <span class="text-6xl font-light text-purple-500 mt-6">°</span>
                                    </div>
                                    
                                    <div class="flex-1 min-w-[200px] space-y-6">
                                        <div class="flex items-center gap-4">
                                            <span class="text-6xl">{{ match($weather['weather'][0]['main'] ?? 'Clear') { 'Rain' => '🌧️', 'Clouds' => '☁️', 'Clear' => '☀️', default => '⛅' } }}</span>
                                            <div>
                                                <p class="text-4xl font-bold text-white capitalize leading-tight">{{ $weather['weather'][0]['description'] ?? 'Establishing...' }}</p>
                                                <p class="text-sm text-slate-400">Feels like {{ round($weather['main']['feels_like'] ?? 0) }}°</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Forecast Strip -->
                                        <div class="flex gap-2 pt-6 border-t border-white/5">
                                            @foreach(['MON', 'TUE', 'WED', 'THU', 'FRI'] as $index => $day)
                                            <div class="flex-1 text-center py-3 bg-white/[0.02] rounded-2xl border border-white/5">
                                                <p class="text-[9px] font-black text-slate-500 mb-1">{{ $day }}</p>
                                                <p class="text-sm font-bold">{{ round(($weather['main']['temp'] ?? 28) + ($index % 2)) }}°</p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Telemetry -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach([
                                ['Wind Speed', ($weather['wind']['speed'] ?? 0).' m/s', 'M14 5l7 7m0 0l-7 7m7-7H3'],
                                ['Humidity', ($weather['main']['humidity'] ?? 0).'%', 'M19 14l-7 7m0 0l-7-7m7 7V3'],
                                ['Air Pressure', ($weather['main']['pressure'] ?? 0).' hPa', 'M13 10V3L4 14h7v7l9-11h-7z']
                            ] as [$label, $val, $path])
                            <div class="bg-black/20 border border-white/5 p-8 rounded-[2.5rem] hover:bg-white/5 transition-all group">
                                <div class="flex justify-between items-center mb-4">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $label }}</p>
                                    <div class="p-2 bg-purple-500/10 rounded-xl">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"></path></svg>
                                    </div>
                                </div>
                                <p class="text-4xl font-bold text-white">{{ $val }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right Sector: Personnel & Logs -->
                    <div class="lg:col-span-4 space-y-10">
                        
                        <!-- Verified Operators (Filtered) -->
                        <div class="bg-white/[0.02] border border-white/10 rounded-[3rem] p-10">
                            <div class="flex justify-between items-center mb-8">
                                <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.3em]">Verified Personnel</h3>
                                <span class="text-[10px] font-bold text-purple-400 bg-purple-400/10 px-2 py-0.5 rounded-lg">{{ count($users) - 1 }} Remote</span>
                            </div>
                            
                            <div class="space-y-4 max-h-[350px] overflow-y-auto custom-scrollbar pr-4">
                                @forelse($users->where('id', '!=', Auth::id()) as $user)
                                <div class="group flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-transparent hover:border-purple-500/20 transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-xs font-black group-hover:text-purple-400 transition-colors">
                                            {{ substr($user['full_name'], 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold">{{ $user['full_name'] }}</p>
                                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-tighter">{{ $user['role'] }}</p>
                                        </div>
                                    </div>
                                    <div class="w-1.5 h-1.5 bg-purple-500/20 rounded-full group-hover:bg-purple-500"></div>
                                </div>
                                @empty
                                <div class="text-center py-10 opacity-20 italic text-sm">No other operators active</div>
                                @endforelse
                            </div>
                        </div>

                        <!-- System Log (New Dynamic Element) -->
                        <div class="bg-black/40 border border-white/5 rounded-[3rem] p-8">
                            <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-6">Activity Feed</h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div class="mt-1 w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                                    <div class="space-y-1">
                                        <p class="text-[11px] font-bold text-slate-300">Satellite Sync Complete</p>
                                        <p class="text-[9px] text-slate-600 font-mono">17:05:12 UTC - Node Alpha</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="mt-1 w-1.5 h-1.5 bg-purple-500 rounded-full"></div>
                                    <div class="space-y-1">
                                        <p class="text-[11px] font-bold text-slate-300">Auth Check: {{ Auth::user()->full_name }}</p>
                                        <p class="text-[9px] text-slate-600 font-mono">17:00:01 UTC - Access Granted</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(168, 85, 247, 0.2); border-radius: 10px; }
    </style>
</x-app-layout>