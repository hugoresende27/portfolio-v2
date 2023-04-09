<x-guest-layout>

    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white p-3">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

                <div class="container">
                    <div>
                        <div class="flex-shrink-0">
                            <img class="inline-block h-40 w-30 rounded-full" src="{{asset('my_images/me.jpg')}}" alt="me">
                        </div>

                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="text-center truncate text-lg font-medium text-blue-950">PHP</dt>
                                <dd class="text-center mt-1 text-3xl font-semibold tracking-tight text-gray-900">87.89%</dd>
                                <div class="bar-container">
                                    <div class="bar" style="width: 87.89%;      background-color: #8892BF;"></div>
                                </div>
                            </div>

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="text-center truncate text-lg font-medium text-blue-950">SQL</dt>
                                <dd class="text-center mt-1 text-3xl font-semibold tracking-tight text-gray-900">81.16%</dd>
                                <div class="bar-container">
                                    <div class="bar" style="width: 81.16%;      background-color: #9da1ad;"></div>
                                </div>
                            </div>

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="text-center truncate text-lg font-medium text-blue-950">Laravel</dt>
                                <dd class="text-center mt-1 text-3xl font-semibold tracking-tight text-gray-900">83.57%</dd>
                                <div class="bar-container">
                                    <div class="bar" style="width: 83.57%;      background-color: #FF2D20;"></div>
                                </div>


                            </div>
                        </dl>
                    </div>
                </div>

        </div>


    </body>
</x-guest-layout>


