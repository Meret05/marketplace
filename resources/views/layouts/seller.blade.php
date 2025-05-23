<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ __('seller.my-store') }}</title>
</head>
<body>
<section>
    <header class="w-full p-4 border-b border-gray-100">
        {{ __('seller.my-store') }}
    </header>
</section>

<section class="flex">
    <aside class="w-1/4 bg-gray-900 min-h-screen">
        <nav>
            <a href="{{ route('client.home') }}" class="block p-4 text-gray-200 border-b border-gray-600">{{ __('seller.dashboard') }}</a>
            <a href="{{ route('seller.attributes.index') }}" class="block p-4 text-gray-200 border-b border-gray-600">{{ __('seller.product-attributes') }}</a>
            <a href="{{ route('seller.attribute-values.index') }}" class="block p-4 text-gray-200 border-b border-gray-600">{{ __('seller.attribute-values') }}</a>
            <a href="{{ route('seller.products.index') }}" class="block p-4 text-gray-200 border-b border-gray-600">{{ __('seller.products') }}</a>
        </nav>
    </aside>
    <article class="w-3/4 bg-gray-50 p-4">
        @yield('seller')
    </article>
</section>

<section>
    <footer>

    </footer>
</section>

</body>
</html>
