<div>


    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Content goes here -->


        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-2 pb-2 pt-2 shadow sm:px-6 sm:pt-6">

                <dt>
                    <div class="absolute">
                        <img id="weather-icon">
                    </div>
                    <p class="truncate text-2xl font-medium text-gray-500"><span id="weather-city"></span></p>
                    <p class="truncate text-2xl font-medium text-gray-500"><span id="weather-localtime"></span></p>
                    <p class="ml-2 flex items-baseline text-2xl font-semibold ">
                        <span id="weather-current" class="text-green-600"></span><span class="text-green-600">&deg;C.</span>  &nbsp;&nbsp;&nbsp;
                        <span id="weather-condition" class="text-black"></span>&nbsp;&nbsp;
                        <span id="weather-wind" class="text-black">Km/h</span>&nbsp;&nbsp;
                        <span id="weather-wind-dir" class="text-black"></span>
                    </p>
                </dt>
            </div>

            <div class="relative overflow-hidden rounded-lg bg-white px-2 pb-2 pt-2 shadow">
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




        </dl>
    </div>



</div>
<script src="js/weather.js"></script>



