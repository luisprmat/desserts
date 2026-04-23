<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Frontend Mentor | {{ __('Product list with cart') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet" />

    @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="max-w-8xl mx-auto grid gap-8 bg-rose-50 px-4 py-16 sm:px-6 md:grid-cols-[1fr_400px] lg:px-8">
    <main>
        <h1 class="text-5xl font-bold">{{ __('Desserts') }}</h1>

        @if ($cart)
            <ul>
                @foreach ($cart->items as $item)
                    <li>{{ $item->product->name }} ({{ $item->quantity }})</li>
                @endforeach
            </ul>
        @endif

        <ul class="mt-10 grid gap-6 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <x-product :product="$product" />
            @endforeach
        </ul>
    </main>
    <x-cart />
</body>

</html>
