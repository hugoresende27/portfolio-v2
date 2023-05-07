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

                    <form>
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Enter Data</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">POST request</p>

                                @if (isset($makeApi->columns))
                                    @foreach($makeApi->columns as $col)
                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <div class="sm:col-span-4">
                                                <label for="{{$col->name}}" class="block text-sm font-medium leading-6 text-gray-900">{{mb_strtolower($col->name ?? "")}}</label>
                                                <div class="mt-2">
                                                    <p class="text-sm leading-6 text-gray-900">{{$col->type ?? ""}}</p>

                                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                        <input type=@if($col->type == 'text')"text" @elseif($col->type == 'boolean')"checkbox" @elseif($col->type == 'data')"date" @else "number" @endif id="{{$col->name}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </form>




                </div>
            </div>



        </div>



    </div>



</x-guest-layout>

<script src="{{asset('js/apimaker.js')}}"></script>

