<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Collections | Premium Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .purple-gradient { background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%); }
    </style>
</head>
<body class="bg-slate-50 min-h-screen pb-20">
    <nav class="sticky top-0 z-50 glass border-b border-purple-100 mb-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-purple-900 to-indigo-600">
                🎸 GUITAR<span class="font-light text-purple-600">COLLECTIONS</span>
            </h1>
            <a href="{{ route('guitars.index') }}" class="text-purple-900 font-semibold hover:text-purple-600 transition">HOME</a>
        </div>
    </nav>

    <div class="container mx-auto px-6">
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-8 bg-green-500 text-white p-4 rounded-2xl shadow-lg flex items-center gap-3 animate-bounce">
                <span></span> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>