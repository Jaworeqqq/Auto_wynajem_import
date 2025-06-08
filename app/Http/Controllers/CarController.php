<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::orderBy('brand')
            ->paginate(12); // 12 na stronę
        return view('cars.index', compact('cars'));
    }

    public function show($slug)
    {
        $car = Car::where('slug', $slug)->firstOrFail();
        return view('cars.show', compact('car'));
    }
}
