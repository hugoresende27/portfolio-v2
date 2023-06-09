<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/my_style.css') }}">

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


    <body class="dark:bg-gray-900 flex flex-col my-back">
        <div class="flex-grow font-sans text-gray-900 dark:text-gray-100 antialiased">
            {{ $slot }}
        </div>
        @if(Route::currentRouteName() !== 'welcome'
            && Route::currentRouteName() !== 'projects.scraper.url'
            && Route::currentRouteName() !== 'projects.news'
            && Route::currentRouteName() !== 'projects.apimaker'
            && Route::currentRouteName() !== 'projects.apimaker.post'
            )
            <x-footer class="mt-auto"></x-footer>
        @else
            <div class="flex flex-col items-center justify-center bottom-0">
                <div class="text-center">
                    <p class="text-white p-3">{{$lastUpdate}}</p>
                </div>
            </div>

        @endif
    </body>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</html>


<script>
    console.info('Last updated by Hugo Resende' );


</script>


<script src="{{asset('js/project.js')}}"></script>
