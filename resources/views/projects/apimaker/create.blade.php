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

                    <form id="createForm">
                        @csrf
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

                                                        @if($col->type == 'text')
                                                            <input required type="text" id="{{$col->name}}" name="{{$col->name}}"  class="block flex-1 border-1 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">

                                                        @elseif($col->type == 'boolean')
                                                            <input required type="checkbox" id="{{$col->name}}" name="{{$col->name}}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        @elseif($col->type == 'data')
                                                            <input required type="date" id="{{$col->name}}" name="{{$col->name}}" class="block flex-1 border-1 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">

                                                        @else
                                                            <input required type="number" id="{{$col->name}}" name="{{$col->name}}" class="block flex-1 border-1 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">

                                                        @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="mt-10">
                                    <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>




                </div>
            </div>



        </div>



    </div>



</x-guest-layout>

<script>


    const formCreate = new FormData(document.querySelector('form'));


    formCreate.addEventListener('submit', async (event) => {
        console.log('aqui')
        event.preventDefault(); // Prevents the default form submission

        const formData = new FormData(formCreate);
        const url = formCreate.action;


        console.log(formData.entries())


        // try {
        //     await Swal.showLoading();
        //     const response = await axios.post(url, formData);
        //     const { success } = response.data;
        //
        //     if (success) {
        //         await Swal.fire({
        //             title: 'Entry created successfully',
        //             color: 'white',
        //             background: '#374151',
        //             confirmButtonColor: '#111827',
        //             confirmButtonText: 'OK',
        //         });
        //
        //     } else {
        //         await Swal.fire({
        //             title: 'Entry NOT created',
        //             color: 'white',
        //             background: '#f55426',
        //             confirmButtonColor: '#030303',
        //             confirmButtonText: 'OK',
        //         });
        //     }
        // } catch (error) {
        //     console.error(error);
        // }
    });



</script>


