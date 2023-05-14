<x-guest-layout>



    {{--    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white px-4 sm:px-20" >--}}
    <div class="relative sm:flex sm:justify-center  bg-center dark:bg-dots-lighter dark:bg-gray-900  selection:text-white px-4 sm:px-20" >
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <div class="">
                        <a href="/">
                            <img src="{{asset("/my_images/my_logo.png")}}" alt="myLogo" width="50px" height="50px" class="rounded-2xl">
                        </a>
                    </div>
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @endauth
            </div>
        @endif



            <div class="mt-10 overflow-x-hidden text-center">
                <x-welcome-topbar>

                </x-welcome-topbar>


                <div class="bg-white rounded-2xl overflow-y-hidden">
                    <div class="bg-white py-6 sm:py-12">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">


                            <x-api_components.news-form-component  :languagesArray="$languagesArray" :countriesArray="$countriesArray">
                            </x-api_components.news-form-component>

                            <x-api_components.news-results-component  :allNews="$allNews"  >
                            </x-api_components.news-results-component>


                        </div>
                    </div>

                </div>


            </div>



</div>



</x-guest-layout>

<script src="{{asset('js/news.js')}}"></script>
