<div>


    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Content goes here -->


        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">


            {{--                NOW         --}}
            <div class="relative overflow-hidden rounded-lg bg-white px-2 pb-2 pt-2 shadow sm:px-2 sm:pt-2  box2 ">
                <span class="truncate text-sm font-medium text-gray-500">Now</span>
                <dt class="ml-6">
                    <div class="absolute">
                        <img id="weather-icon">
                    </div>
                    <p class="truncate text-2xl font-medium text-gray-500"><span id="weather-city"></span></p>
                    <p class="truncate text-2xl font-medium text-gray-500"><span id="weather-localtime"></span></p>
                    <p class="ml-2 flex items-baseline text-2xl font-semibold ">
                        <span id="weather-current" class="text-sm text-green-600"></span><span class="text-green-600 text-sm">&deg;C.</span>  &nbsp;&nbsp;&nbsp;
                        <span id="weather-condition" class="text-sm text-black"></span>&nbsp;&nbsp;
                        <span id="weather-wind" class="text-sm text-black"></span>&nbsp<span class="text-sm text-black">Km/h</span>&nbsp;
                        <span id="weather-wind-dir" class="text-sm text-black"></span>

                    </p>
                </dt>
            </div>


            {{--                LOCATION         --}}
            <div class="relative overflow-hidden rounded-lg bg-white px-2 pb-2 pt-2 shadow box">
                <div>
                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Location</label>
                    <select id="location" name="location" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6">
                        <option class="text-lg" value="Coimbra">Coimbra</option>
                        <option class="text-lg" value="Lisboa">Lisboa</option>
                        <option class="text-lg" selected value="Aveiro">Aveiro</option>
                        <option class="text-lg" value="Figueira da Foz">Figueira da Foz</option>
                        <option class="text-lg" value="Montemor-O-Velho">Montemor-O-Velho</option>
                        <option class="text-lg" value="Guimarães">Guimarães</option>
                        <option class="text-lg" value="Beja">Beja</option>
                    </select>
                </div>
                <div class="relative mt-1">
                       <input type="text" name="place" id="place" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Some place...">
                </div>

            </div>


            {{--                14 DAYS         --}}
            <div class="relative overflow-hidden rounded-lg bg-white px-2 pb-2 pt-2 shadow sm:px-6 sm:pt-2 box3">

{{--                <span class="truncate text-sm font-medium text-gray-500">14 days</span>--}}
{{--                <dt>--}}
{{--                    <div class="absolute">--}}
{{--                        <img id="weather-icon-future">--}}
{{--                    </div>--}}
{{--                    <p class="truncate text-2xl font-medium text-gray-500"><span id="weather-city-future"></span></p>--}}

{{--                    <p class="ml-20 flex items-baseline text-2xl font-semibold ">--}}
{{--                        <span id="weather-current-future" class="text-green-600 ml-5"></span><span class="text-green-600">&deg;C.</span>--}}
{{--                        <span id="weather-wind-future" class="text-black"></span>&nbsp;--}}
{{--                        <span class="text-black">Km/h</span>&nbsp;--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        <span class="text-black">Sunrise</span>&nbsp;--}}
{{--                        <span id="weather-sunrise-future" class="text-black"></span>&nbsp;--}}
{{--                        <span class="text-black">Sunset</span>&nbsp;--}}
{{--                        <span id="weather-sunset-future" class="text-black"></span>&nbsp;--}}
{{--                    </p>--}}
{{--                </dt>--}}

                {{--                NEWS        --}}
                <a href="{{route('projects.news')}}">
                    <span class="truncate text-sm font-medium text-gray-500">News</span>
                </a>
                <dt id="news" style="color: black">

                </dt>
            </div>




        </dl>
    </div>



</div>
<script src="{{asset('js/weather.js')}}"></script>




