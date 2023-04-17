<x-guest-layout>



{{--    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white px-4 sm:px-20" >--}}
    <div class="relative sm:flex sm:justify-center  bg-center dark:bg-dots-lighter dark:bg-gray-900  selection:text-white px-4 sm:px-20" >
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--                    @endif--}}
                @endauth
            </div>
        @endif





            <div class="overflow-hidden ">



                <div class=" text-center py-16 sm:py-4">

{{--                    FIRST BOX--}}

                    <x-welcome-first :quote="$quote">

                    </x-welcome-first>

                    <div class="">

                        {{--                     THIRD BOX--}}

                        <x-welcome-third>

                        </x-welcome-third>

                    </div>


                    {{--                    WEATHER BOX--}}
                    <x-api_components.weather />

{{--                    SECOND BOX--}}

                   <x-welcome-second>

                   </x-welcome-second>




                </div>






            </div>


    </div>



</x-guest-layout>


