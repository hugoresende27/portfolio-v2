<x-guest-layout>



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
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 bg-white rounded-2xl p-5 text-center p-3 m-3 ">

                    <x-makeapi.side-menu-component>

                    </x-makeapi.side-menu-component>


                </div>
                <div class="col-span-9 bg-white rounded-2xl p-5">

                    <div class="text-center">
                        <p>Model Details</p>
                    </div>
                    <ul role="list" class="divide-y divide-gray-100">

                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Model Name</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">{{$makeApi->modelName ?? ""}}</p>
                            </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Name</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">Type</p>
                            </div>
                        </li>
                        @if (isset($makeApi->columns))
                            @foreach($makeApi->columns as $col)
                                <li class="flex justify-between gap-x-6 py-5">
                                    <div class="flex gap-x-4">
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-sm font-semibold leading-6 text-gray-900">{{mb_strtolower($col->name ?? "")}}</p>
                                        </div>
                                    </div>
                                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                                        <p class="text-sm leading-6 text-gray-900">{{$col->type ?? ""}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                    </ul>

                    <hr>

                    <div class="text-center">
                        <p>Enpoints  generated</p>
                    </div>
                    <ul role="list" class="divide-y divide-gray-100">

                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                               <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Create new entry</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">{{$makeApi->routes->POST ?? ""}}</p>
                            </div>
                        </li>

                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Update(Edit) entry</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">{{$makeApi->routes->PUT ?? ""}}</p>
                            </div>
                        </li>

                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Show entry</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">{{$makeApi->routes->GET ?? ""}}</p>
                            </div>
                        </li>

                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Show All entries</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">{{$makeApi->routes->GET1 ?? ""}}</p>
                            </div>
                        </li>

                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">Delete entry</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900">{{$makeApi->routes->DELETE ?? ""}}</p>
                            </div>
                        </li>

                    </ul>



                </div>
            </div>



        </div>



    </div>



</x-guest-layout>

<script src="{{asset('js/apimaker.js')}}"></script>

