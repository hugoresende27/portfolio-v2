<x-guest-layout>



{{--    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white px-4 sm:px-20" >--}}
    <div class="relative sm:flex sm:justify-center  min-h-screen bg-center dark:bg-dots-lighter dark:bg-gray-900  selection:text-white px-4 sm:px-20" >
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





            <div class="overflow-hidden ">



                <div class=" bg-gray-900 py-16 sm:py-4">

                    <div class="mx-auto max-w-7xl px-6 lg:px-8 mb-5 ">
                        <div class="mx-auto max-w-2xl lg:max-w-none">
                            <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
                                <div class="flex flex-col bg-white/5 p-0">
                                    <img src="https://picsum.photos/1920/1080" alt="">
                                </div>


                                <div class="flex flex-col bg-white/5 p-8">
                                    <a href="">
                                    <dt class="text-4xl font-semibold leading-6 text-gray-300">My Projects</dt>
                                    <dd class="order-first text-3xl font-semibold tracking-tight text-white">

                                    </dd>
                                    </a>
                                </div>


                                <div class="flex flex-col bg-white/5 p-8">
                                    <a href="">
                                        <dt class="text-4xl font-semibold leading-6 text-gray-300">CV</dt>
                                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">

                                        </dd>
                                    </a>
                                </div>

                                <div class="flex flex-col bg-white/5 p-8">
                                    <a href="">
                                        <dt class="text-4xl font-semibold leading-6 text-gray-300">Contacts</dt>
                                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">

                                        </dd>
                                    </a>
                                </div>
                            </dl>
                        </div>
                    </div>


                    <div class="">
                        <div class="">
                            <dl class="">
                                <div class="flex flex-col bg-white/5 p-8">
                                    <dt class="text-sm font-semibold leading-6 text-gray-300">API where , getting some weather or inspirational sentence</dt>
                                </div>

                            </dl>
                        </div>
                    </div>

                </div>


                <div class=" px-4 py-5 sm:p-6 rounded-lg bg-gray-700 shadow mt-0">

                    <!-- Content goes here -->
                    <div>

                        <div class="flex">
                            <div class="mr-4 flex-shrink-0 self-center">

                                <img class="inline-block w-40 rounded-full border border-gray-900 border-8" src="{{asset('my_images/me.jpg')}}" alt="me">

                            </div>
                            <div class="mt-8">
                                <h4 class="text-sm sm:text-2xl  font-bold">About me</h4>
                                <p class="text-sm sm:text-xl mt-1 text-justify  ">
                                    My name is Hugo Resende and I'm a web developer with a passion for working with databases and REST APIs. I am skilled in Laravel, but I also enjoy exploring new PHP and non-PHP frameworks. I am always looking to learn and grow as a developer, and I am excited about the possibilities that new technologies and frameworks can bring.
                                </p>
                            </div>
                        </div>


                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="text-center truncate text-lg font-medium text-blue-950">PHP</dt>
                                <dd class="text-center mt-1 text-3xl font-semibold tracking-tight text-gray-900">97.89%</dd>
                                <div class="bar-container">
                                    <div class="bar" style="width: 87.89%;      background-color: #8892BF;"></div>
                                </div>
                            </div>

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="text-center truncate text-lg font-medium text-blue-950">SQL</dt>
                                <dd class="text-center mt-1 text-3xl font-semibold tracking-tight text-gray-900">91.16%</dd>
                                <div class="bar-container">
                                    <div class="bar" style="width: 81.16%;      background-color: #9da1ad;"></div>
                                </div>
                            </div>

                            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="text-center truncate text-lg font-medium text-blue-950">Laravel</dt>
                                <dd class="text-center mt-1 text-3xl font-semibold tracking-tight text-gray-900">93.57%</dd>
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


