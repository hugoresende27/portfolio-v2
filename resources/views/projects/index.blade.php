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





        <div class="overflow-hidden ">
            <x-welcome-first :quote="$quote">

            </x-welcome-first>
            <div class="h-500 text-center py-16 sm:py-4 ">
                <div class=" text-center py-16 sm:py-4">



                    <div>


                        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                            <a href="{{route('projects.elastic')}}">
                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                    <div class="flex flex-1 flex-col p-8">
                                        <img class="mx-auto h-32 w-32 flex-shrink-0"
                                             src="{{asset('my_images/projects/es.jpg')}}" alt="elasticsearch">
                                    </div>

                                </li>
                            </a>

                            <!-- More people... -->
                        </ul>

                    </div>

                </div>
            </div>


        </div>






    </div>



</x-guest-layout>


