<x-guest-layout>



    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white px-4 sm:px-20" >
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

            <div class="overflow-hidden rounded-lg bg-gray-700 shadow">
                <div class="px-4 py-5 sm:p-6">
                    <!-- Content goes here -->
                    <div>

                        <div class="flex">
                            <div class="mr-4 flex-shrink-0 self-center">
                                <img class="inline-block w-40 rounded-full" src="{{asset('my_images/me.jpg')}}" alt="me">
                            </div>
                            <div>
                                <h4 class="text-4xl font-bold">About me</h4>
                                <p class="text-2xl mt-1 text-justify">
                                    My name is Hugo Resende and I'm a web developer with a passion for working with databases and REST APIs. I am skilled in Laravel, but I also enjoy exploring new PHP and non-PHP frameworks. I am always looking to learn and grow as a developer, and I am excited about the possibilities that new technologies and frameworks can bring.
                                </p>
                            </div>
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


    </div>



</x-guest-layout>


