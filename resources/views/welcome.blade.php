<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Frontend Mentor | {{ __('Product list with cart') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet"
    />

    <link rel="icon" href="/favicon/favicon-16x16.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="/favicon/favicon-32x32.png" sizes="32x32" type="image/png" />
    <link rel="apple-touch-icon" href="/favicon/apple-touch-icon.png" sizes="180x180" type="image/png" />
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" type="image/svg" />

    @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <livewire:container />
</body>
</html>
