<form method="POST" action="{{ route('submitFormNews') }}" onSubmit="handleSubmit(event)" id="newsForm">
@csrf
<div class="space-y-12">
        <div class="border-b border-gray-900/10">
            <div class="text-center">
                <h1 class="text-2xl text-base font-semibold leading-7 text-gray-900">Search News</h1>
            </div>
            <div class="mt-10 grid grid-cols-2 gap-4">

                <div class="bg-gray-100 p-4 rounded p-3">
                    <div class="">
                        <div class="text-center">
                            <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Subject</label>
                        </div>
                        <div class="m-5">
                            <div class=" rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 ">
                                <input id="subject" type="text"  class=" border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    <div class="">

                        <div class="text-center">
                            <label for="language" class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                        </div>
                        <div class="m-5">
                            <div style="display: flex; justify-content: center;">
                                <select id="language" name="language" autocomplete="language" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                  @if (isset($languagesArray))
                                       @foreach($languagesArray as $key => $lang)
                                            @if($key == 'pt')
                                                <option value="{{ $key }}" selected>{{ $lang }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $lang }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="text-center">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                        </div>
                        <div class="m-5">
                            <div style="display: flex; justify-content: center;">
                                <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @if (isset($countriesArray))

                                        @foreach($countriesArray as $key => $country)
                                            @if($key == 'pt')
                                                <option value="{{ $key }}" selected>{{ $country }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $country }}</option>
                                            @endif
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-100 p-4 rounded">
                    <p class="text-lg leading-6 text-gray-600 text-center p-2">Choose category (max 5)</p>
                    <div class="grid grid-cols-2 gap-4" id="categories" >
                        <div class="text-center p-3">
                            <input id="business" name="business" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="business" class="block text-sm font-medium leading-6 text-gray-900">business</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="entertainment" name="entertainment" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="entertainment" class="block text-sm font-medium leading-6 text-gray-900">entertainment</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="environment" name="environment" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="environment" class="block text-sm font-medium leading-6 text-gray-900">environment</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="food" name="food" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="food" class="block text-sm font-medium leading-6 text-gray-900">food</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="health" name="health" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="health" class="block text-sm font-medium leading-6 text-gray-900">health</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="politics" name="politics" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="politics" class="block text-sm font-medium leading-6 text-gray-900">politics</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="science" name="science" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="science" class="block text-sm font-medium leading-6 text-gray-900">science</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="sports" name="sports" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="sports" class="block text-sm font-medium leading-6 text-gray-900">sports</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="technology" name="technology" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="technology" class="block text-sm font-medium leading-6 text-gray-900">technology</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="top" name="top" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="top" class="block text-sm font-medium leading-6 text-gray-900">top</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="tourism" name="tourism" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="tourism" class="block text-sm font-medium leading-6 text-gray-900">tourism</label>
                        </div>
                        <div class="text-center p-3">
                            <input id="world" name="world" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="world" class="block text-sm font-medium leading-6 text-gray-900">world</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button"
                                class="rounded-full
                                bg-indigo-600 px-2.5 py-1
                                text-xs font-semibold text-white
                                shadow-sm hover:bg-indigo-500
                                focus-visible:outline focus-visible:outline-2
                                focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                id="clear-btn">
                            Clear</button>
                    </div>

                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                        class="rounded-full mb-5 w-96
                        bg-indigo-600 px-6 py-4
                        text-2xl font-semibold text-white
                        shadow-lg hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                        focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-5">
                    Search
                </button>
            </div>
        </div>

    </div>


</form>

