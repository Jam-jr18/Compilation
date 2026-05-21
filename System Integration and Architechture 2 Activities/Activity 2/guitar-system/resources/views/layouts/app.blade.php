<!DOCTYPE html>
<html>
<head>
    <title>Guitar Songs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <style>
        body {
            background: linear-gradient(135deg, #f5f3ff, #cd28fb);
            font-family: 'Segoe UI', sans-serif;
        }

        /* Navbar */
        .navbar {
            background: rgba(121, 47, 251, 0.9);
            backdrop-filter: blur(10px);
            color: white;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #fa60e8, #a78bfa);
            color: white;
            padding: 60px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        /* Search */
        .search-box {
            border-radius: 30px;
            padding: 12px 20px;
            border: dark;
            width: 60%;
            outline: dark purple;
            box-shadow: 0 0 15px rgba(75, 5, 118, 0.5);
        }

        /* Glass Card */
        .song-card {
            background: rgba(237, 212, 253, 0.6);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 20px;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
        }

        .song-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 40px rgba(8, 1, 19, 0.4);
        }

        /* Artist Image */
        .artist-img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 2px solid gray;
            object-fit: cover;
            transition: 0.3s;
        }

        .song-card:hover .artist-img {
            transform: scale(1.1);
        }

        /* Play Button Overlay */
        .play-btn {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: #ff2268;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            opacity: 0;
            transition: 0.3s;
        }

        .song-card:hover .play-btn {
            opacity: 1;
        }

        /* Badge */
        .badge-custom {
            background: #520460;
            padding: 6px 12px;
            border-radius: 20px;
        }

        /* Detail Box */
        .detail-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .chords-box {
            background: #1c0328;
            padding: 15px;
            border-radius: 12px;
            font-family: monospace;
            white-space: pre-line;
        }

        .btn-back {
            background: #8444f2e1;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
        }

        
        
    </style>
    
</head>

<body>

<nav class="navbar p-3">
    <div class="container">
        <h4> Guitar Songs & Chords</h4>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>