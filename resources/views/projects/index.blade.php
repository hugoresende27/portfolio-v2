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



                            {{--                        SCRAPPER     --}}
                            <a href="{{route('projects.scraper')}}">
                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                    <div class="flex flex-1 flex-col p-2">
                                        <img class="mx-auto flex-shrink-0 rounded-2xl object-cover"
                                             style="width: 50%; height: 50%;"
                                             src="{{asset('my_images/projects/scraper.png')}}" alt="scraper">
                                    </div>

                                </li>
                            </a>


                            {{--                        NEWS     --}}
                            <a href="{{route('projects.news')}}">
                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                    <div class="flex flex-1 flex-col p-2">
                                        <img class="mx-auto flex-shrink-0 rounded-2xl object-cover"
                                             style="width: 50%; height: 50%;"
                                             src="{{asset('my_images/projects/news.png')}}" alt="scraper">
                                    </div>

                                </li>
                            </a>


                            {{--                        HORIZON     --}}
                            <a href="{{route('projects.horizon')}}">
                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                    <div class="flex flex-1 flex-col p-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="210" height="130" viewBox="0 0 226 30">
                                            <path fill="#405263" d="M54.132 25l-.644-4.144h-5.936V5.68h-4.788V25h11.368zm13.3 0H63.68l-.28-1.708c-1.12 1.176-2.436 1.988-4.312 1.988-2.184 0-3.724-1.316-3.724-3.808 0-3.22 2.464-4.732 7.84-5.208v-.252c0-1.204-.672-1.736-2.072-1.736-1.54 0-2.968.392-4.424 1.036l-.504-3.192c1.568-.644 3.332-1.064 5.572-1.064 3.78 0 5.656 1.26 5.656 4.76V25zm-4.228-3.78v-2.912c-2.884.448-3.668 1.4-3.668 2.604 0 .868.532 1.344 1.316 1.344.812 0 1.596-.364 2.352-1.036zm15.876-5.908L78.38 11c-2.016.14-3.164 1.428-4.004 2.996l-.448-2.716h-3.696V25h4.228v-7.616c1.036-1.12 2.576-1.932 4.62-2.072zM92.184 25h-3.752l-.28-1.708c-1.12 1.176-2.436 1.988-4.312 1.988-2.184 0-3.724-1.316-3.724-3.808 0-3.22 2.464-4.732 7.84-5.208v-.252c0-1.204-.672-1.736-2.072-1.736-1.54 0-2.968.392-4.424 1.036l-.504-3.192c1.568-.644 3.332-1.064 5.572-1.064 3.78 0 5.656 1.26 5.656 4.76V25zm-4.228-3.78v-2.912c-2.884.448-3.668 1.4-3.668 2.604 0 .868.532 1.344 1.316 1.344.812 0 1.596-.364 2.352-1.036zm19.544-9.94h-4.116l-2.492 8.484-2.548-8.68-4.536.532 4.676 13.44h4.228L107.5 11.28zm13.552 6.832c0 .42-.028.868-.084 1.092h-8.232c.224 2.156 1.512 2.996 3.36 2.996 1.512 0 2.996-.56 4.508-1.428l.42 2.968c-1.484.952-3.304 1.54-5.46 1.54-4.116 0-7.056-2.184-7.056-7.084 0-4.48 2.744-7.196 6.468-7.196 4.2 0 6.076 3.136 6.076 7.112zm-4.032-1.232c-.14-2.072-.868-3.136-2.156-3.136-1.176 0-2.016 1.036-2.156 3.136h4.312zM127.66 25V4.784l-4.256.672V25h4.256zm25.032 0V5.68h-1.932v8.344h-10.724V5.68h-1.932V25h1.932v-9.24h10.724V25h1.932zm15.876-6.608c0 4.368-2.632 6.888-6.02 6.888-3.388 0-5.936-2.52-5.936-6.888 0-4.396 2.604-6.916 5.936-6.916 3.444 0 6.02 2.52 6.02 6.916zm-1.904 0c0-3.052-1.456-5.348-4.116-5.348-2.632 0-4.06 2.212-4.06 5.348 0 3.052 1.456 5.32 4.06 5.32 2.688 0 4.116-2.184 4.116-5.32zm12.208-5.18l-.308-1.736c-2.184.056-3.724 1.512-4.704 2.996l-.42-2.716h-1.372V25h1.848v-8.316c.896-1.764 2.772-3.332 4.956-3.472zm5.264-5.964c0-.728-.588-1.344-1.316-1.344-.728 0-1.344.616-1.344 1.344 0 .728.616 1.344 1.344 1.344.728 0 1.316-.616 1.316-1.344zM183.716 25V11.756h-1.82V25h1.82zm13.748 0l-.252-1.54h-7.868l7.896-10.276v-1.428h-9.604l.252 1.54h7.224l-7.896 10.276V25h10.248zm14.476-6.608c0 4.368-2.632 6.888-6.02 6.888-3.388 0-5.936-2.52-5.936-6.888 0-4.396 2.604-6.916 5.936-6.916 3.444 0 6.02 2.52 6.02 6.916zm-1.904 0c0-3.052-1.456-5.348-4.116-5.348-2.632 0-4.06 2.212-4.06 5.348 0 3.052 1.456 5.32 4.06 5.32 2.688 0 4.116-2.184 4.116-5.32zM225.884 25v-9.464c0-2.548-1.316-4.06-3.948-4.06-1.792 0-3.304.952-4.76 2.24l-.308-1.96h-1.428V25h1.848v-9.576c1.456-1.428 2.884-2.296 4.284-2.296 1.68 0 2.464 1.036 2.464 2.744V25h1.848z"/>
                                            <path fill="#405263" d="M5.26176342 26.4094389C2.04147988 23.6582233 0 19.5675182 0 15c0-4.1421356 1.67893219-7.89213562 4.39339828-10.60660172C7.10786438 1.67893219 10.8578644 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15-3.716753 0-7.11777662-1.3517984-9.73823658-3.5905611zM4.03811305 15.9222506C5.70084247 14.4569342 6.87195416 12.5 10 12.5c5 0 5 5 10 5 3.1280454 0 4.2991572-1.9569336 5.961887-3.4222502C25.4934253 8.43417206 20.7645408 4 15 4 8.92486775 4 4 8.92486775 4 15c0 .3105915.01287248.6181765.03811305.9222506z"/>
                                        </svg>
                                    </div>

                                </li>
                            </a>

                            {{--                        ELASTIC     --}}
                            <a href="{{route('projects.elastic')}}">
                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                    <div class="flex flex-1 flex-col p-8">
                                        <img class="mx-auto h-32 w-32 flex-shrink-0"
                                             src="{{asset('my_images/projects/Elasticsearch_logo.svg')}}" alt="elasticsearch">
                                    </div>

                                </li>
                            </a>


                            {{--                        SWAGGER     --}}
                            <a href="{{url('/api/documentation')}}" target="_blank">
                                <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                                    <div class="flex flex-1 flex-col p-2">
                                        <img class="mx-auto flex-shrink-0 rounded-2xl object-cover"
                                             style="width: 50%; height: 50%;"
                                             src="{{asset('my_images/projects/swagger.svg')}}" alt="swaggerlogo">
                                    </div>

                                </li>
                            </a>


                        </ul>

                    </div>

                </div>
            </div>


        </div>






    </div>



</x-guest-layout>


