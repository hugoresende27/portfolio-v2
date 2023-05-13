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

                    <a href="{{route('template')}}">
                        <button type="button" class="rounded-full px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900">Home</button>
                    </a>
                    <a href="{{route('projects')}}">
                        <button type="button" class="rounded-full  px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900">Projects</button>
                    </a>
                    <a href="{{asset('cv/cv.pdf')}}" target="_blank">
                        <button type="button" class="rounded-full px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900">CV</button>
                    </a>
                    <a href="{{route('contact-me')}}">
                        <button type="button" class="rounded-full px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900">Contact me</button>
                    </a>
{{--                    <a href="https://github.com/hugoresende27/" target="_blank">--}}
{{--                        <button type="button" class="rounded-full px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900">Github</button>--}}
{{--                    </a>--}}
{{--                    <a href="https://www.linkedin.com/in/hugo-resende-781ab1111/" target="_blank">--}}
{{--                        <button type="button" class="rounded-full px-4 py-2.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900">Linkedin</button>--}}
{{--                    </a>--}}

                    <hr class="m-5">

                    <div class="ml-4 flex-shrink-0 self-center">
                        <a href="{{route('projects')}}">
                            <button>

                                <img class="h-48 w-48 rounded-full" src="{{asset('my_images/me.jpg')}}" alt="me">

                            </button>
                        </a>
                    </div>



                    <h1 class="text-white mt-8 mb-4 text-center text-3xl sm:text-4xl uppercase font-bold">Hugo Resende</h1>
                    <hr class="m-5">
                    <p class="text-white text-center text-xl sm:text-2xl">PHP Developer</p>

                    <div class="text-center">
                        <a href="https://github.com/hugoresende27/" target="_blank" class="m-3">
                            <i class="fab fa-github fa-inverse fa-2x"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/hugo-resende-781ab1111/" target="_blank" class="m-3">
                            <i class="fab fa-linkedin fa-inverse fa-2x"></i>
                        </a>

                    </div>

                </div>

            </div>

    </div>

    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

</x-guest-layout>


