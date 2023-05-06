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
                    <div class="bg-white py-6 sm:py-12">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">

                            <form method="POST" action="{{route('projects.apimaker.post')}}">
                                @csrf
                                <div class="space-y-12">
                                    <div class="border-b border-gray-900/10 pb-12">

                                        <p class="mt-1 text-sm leading-6 text-gray-600">Let's create an API, fill the form with the model name, fields and fields type</p>

                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <div class="sm:col-span-4">
                                                <label for="modelName" class="block text-sm font-medium leading-6 text-gray-900">Model name</label>
                                                <div class="mt-2">
                                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                        <input required type="text" name="modelName" id="modelName" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Post">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="border-b border-gray-900/10 pb-12">
                                        <h2 class="text-base font-semibold leading-7 text-gray-900">Columns of the model</h2>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">Insert how many columns and column type you need</p>

                                        <div class="text-center m-3 p-3">
                                            <button id="add-button" type="button" class="w-10 rounded-full bg-indigo-600 p-2 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                               <span class="text-2xl"> + </span>
                                            </button>
                                            <button id="minus-button" type="button" class="w-10 rounded-full bg-indigo-600 p-2 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                <span class="text-2xl"> - </span>
                                            </button>

                                        </div>

                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6" id="fields-container">



                                                <div class="sm:col-span-3">
                                                    <label for="colName1" class="block text-sm font-medium leading-6 text-gray-900">Column Name</label>
                                                    <div class="mt-2">
                                                        <input required type="text" name="colName1" id="colName" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>

                                                    <label for="colType1" class="block text-sm font-medium leading-6 text-gray-900">Column Type</label>
                                                    <div class="mt-2">
                                                        <select id="colType1" name="colType1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                            <option value = "integer">Integer</option>
                                                            <option value = "float">Decimal</option>
                                                            <option value = "text">Text</option>
                                                            <option value = "data">Data</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>




                                    </div>

                                    <div class="mt-6 flex items-center justify-end gap-x-6">
                                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="reloadForm()">Cancel</button>
                                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>


            </div>



</div>



</x-guest-layout>

<script src="{{asset('js/apimaker.js')}}"></script>

