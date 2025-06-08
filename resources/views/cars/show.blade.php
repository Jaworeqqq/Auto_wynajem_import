@extends('layouts.app')

@section('content')
    <article class="prose dark:prose-invert mx-auto bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">
        <header class="mb-6">
            <h1 class="text-3xl font-extrabold">{{ $car->brand }} {{ $car->model }}</h1>
            <p class="text-xl text-brand font-semibold">{{ number_format($car->price_per_month,0,',',' ') }} PLN / miesiąc</p>
        </header>

        <div class="grid gap-6 lg:grid-cols-2 mb-8">
            @foreach(json_decode($car->images) as $img)
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ $img }}" alt="" class="object-cover w-full h-full">
                </div>
            @endforeach
        </div>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Specyfikacja</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex justify-between">
                    <dt class="font-medium">Paliwo</dt><dd class="text-gray-700 dark:text-gray-300">{{ $car->fuel }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="font-medium">Skrzynia</dt><dd class="text-gray-700 dark:text-gray-300">{{ $car->transmission }}</dd>
                </div>
                @foreach(json_decode($car->specs,true) as $key=>$value)
                    <div class="flex justify-between">
                        <dt class="font-medium">{{ ucfirst($key) }}</dt><dd class="text-gray-700 dark:text-gray-300">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>

        <div class="text-center">
            <a href="{{ route('cars.index') }}" class="inline-block px-6 py-3 bg-brand hover:bg-brand-dark text-white font-semibold rounded-lg shadow transition">← Powrót do listy</a>
        </div>
    </article>
@endsection
