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



            <div class="mt-10">
                <div class="bg-white rounded-2xl">
                    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-x-8 lg:px-8 lg:py-32">

                        <div class="lg:col-span-4">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 text-center">HR Scraper</h2>

                            <div class="text-center bg-white p-8 rounded-2xl">

                                <form action="{{route('projects.scraper.url')}}" method="POST">

                                    @csrf
                                    <label for="url" class="block text-lg font-medium text-gray-900 mb-2">website URL</label>
                                    <div class="rounded-md px-3 pb-1.5 pt-2.5 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600 mb-2">
                                        <input type="text" name="url" id="url" class="block w-full border-0 p-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-lg sm:leading-6" placeholder="www.website.com">
                                    </div>
                                    <button type="submit" class="mt-6 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Scrap</button>


                                </form>
                            </div>
                        </div>

                        <div class="mt-16 lg:col-span-7 lg:col-start-6 lg:mt-0">


                            <div class="flow-root">
                                <div class="-my-12 divide-y divide-gray-200">
                                    <div class="py-12">
                                        <div class="flex items-center">
                                         <div class="">
                                             <h1>Scrap Results</h1>
                                             @if (!empty($responseMessage))
                                                 <x-scrap-response :message="$responseMessage" />
                                             @endif
                                            </div>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>







</x-guest-layout>

{{--<script src="{{asset('js/scraper.js')}}"></script>--}}
