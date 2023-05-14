<x-guest-layout>



    {{--    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white px-4 sm:px-20" >--}}
    <div class="relative sm:flex sm:justify-center  bg-center dark:bg-dots-lighter dark:bg-gray-900  selection:text-white px-4 sm:px-20" >



        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <div class="">
                        <a href="/">
                            <img src="{{asset("/my_images/my_logo.png")}}" alt="myLogo" width="50px" height="50px" class="rounded-2xl">
                        </a>
                    </div>
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <span style="color: white; cursor: pointer;" onmouseover="this.style.color='white'" onmouseout="this.style.color='black' ">Log in</span>


                    </a>

                @endauth
            </div>
        @endif





        <div class="overflow-hidden ">



            <div class=" text-center py-16 sm:py-4">


                <x-welcome-topbar>

                </x-welcome-topbar>

{{--                    FIRST BOX--}}

                <x-welcome-first :quote="$quote">

                </x-welcome-first>


                <hr class="mt-5 mb-5">
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


