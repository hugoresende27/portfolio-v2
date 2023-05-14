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





        <div class="overflow-hidden text-center">
            <div class="m-5">
                <x-welcome-topbar>

                </x-welcome-topbar>
            </div>
            <div class="h-500 text-center py-16 sm:py-4 ">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-white">Elastic Demo</h1>
                            <p class="mt-2 text-sm text-white">A list of all the users in your account including their name, street, number and code.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Street</th>
                                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Number</th>
                                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Code</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach($data as $d)
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{$d->name}}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">      {{$d->street}}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">      {{$d->number}}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">      {{$d->code}}</td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, {{$d->name}}</span></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <!-- More people... -->
                                        </tbody>
                                    </table>
                                    <div class="my-6">
                                        {{ $data->links() }}
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


