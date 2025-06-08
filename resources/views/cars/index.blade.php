@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Nasza flota</h2>
        <input
            type="text"
            x-data
            x-model="search"
            @input.debounce.300ms="$wire.set('search', search)"
            placeholder="Szukaj..."
            class="w-1/3 px-4 py-2 border rounded-lg focus:ring focus:ring-brand focus:border-brand transition"
        />
    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($cars as $car)
            <a href="{{ route('cars.show', $car->slug) }}"
               class="group block bg-white dark:bg-gray-800 rounded-2xl shadow-card overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                @if($car->images)
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ json_decode($car->images)[0] }}"
                             alt="" class="object-cover w-full h-full group-hover:opacity-90 transition-opacity" />
                    </div>
                @endif
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $car->brand }} {{ $car->model }}</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $car->year }}</p>
                    <div class="mt-3 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-brand">{{ number_format($car->price_per_month,0,',',' ') }} PLN</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">/mies.</span>
                    </div>
                    <div class="mt-4 space-x-2">
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded">{{ ucfirst($car->fuel) }}</span>
                        <span class="inline-block bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded">{{ ucfirst($car->transmission) }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $cars->links() }}
    </div>
@endsection
