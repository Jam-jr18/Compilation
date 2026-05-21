<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User; 

class WeatherController extends Controller
{
    /**
     * Handle the dashboard view with integrated API data.
     */
    public function index()
    {
        // 1. Configuration
        // IMPORTANT: Replace with your actual key from OpenWeatherMap
        $apiKey = '555d60b05379c4f857e93537b98f649e'; 
        $city = 'Manila';

        // 2. Fetch Weather Data (Public API Integration)
        $weatherResponse = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'units' => 'metric',
            'appid' => $apiKey,
        ]);

        // 3. Fetch User Data (Internal System Integration)
        // Using User::all() avoids local server timeout issues
        $users = User::all(); 

        // 4. Return the enhanced Dashboard view
        return view('dashboard', [
            'weather' => $weatherResponse->json(),
            'users' => $users
        ]);
    }
}