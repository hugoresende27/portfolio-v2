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



            <div class="mt-10 overflow-x-hidden">
                <div class="bg-white rounded-2xl overflow-y-hidden">
                    <div class="bg-white py-24 sm:py-32">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">

                            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                                @foreach($allNews as $new)

                                    <article class="flex max-w-xl flex-col items-start justify-between">
                                        <div class="flex items-center gap-x-4 text-xs">
                                            <time datetime="2020-03-16" class="text-gray-500">{{$new['pubDate']}}</time>
                                            <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                                                {{$new['creator'][0]}}
                                            </a>
                                        </div>
                                        <div class="group relative">
                                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                                <a href="{{$new['link']}}" target="_blank">
                                                    <span class="absolute inset-0"></span>
                                                    {{$new['title']}}
                                                </a>
                                            </h3>
                                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                                {{$new['description']}}
                                            </p>
                                        </div>
                                        <div class="relative mt-8 flex items-center gap-x-4">
                                            <img src=
                                                     "{{$new['image_url']}}"
                                                 alt="" class="h-10 w-10 rounded-full bg-gray-50">
                                            <div class="text-sm leading-6">
                                                <p class="font-semibold text-gray-900">
                                                    <a href="#">
                                                        <span class="absolute inset-0"></span>
                                                        {{$new['creator'][0]}}
                                                    </a>
                                                </p>
                                                <p class="text-gray-600">{{$new['country'][0]}}</p>
                                            </div>
                                        </div>
                                    </article>

                                @endforeach

                                <!-- More posts... -->
                            </div>
                        </div>
                    </div>

                </div>


            </div>



</div>



</x-guest-layout>


