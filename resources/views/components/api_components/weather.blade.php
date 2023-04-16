<div>
{{--    <div id="weather-info" class="flex">--}}
{{--        <ul class="flex flex-row list-none">--}}
{{--            <li id="weather-city" class="inline-block"></li>--}}
{{--            <li id="weather-localtime" class="inline-block"></li>--}}
{{--        </ul>--}}
{{--    </div>--}}
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Content goes here -->


        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <div class="relative overflow-hidden rounded-lg bg-white px-2 pb-2 pt-2 shadow sm:px-6 sm:pt-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900 mb-5 text-center">Weather API</h3>
                <dt>
                    <div class="absolute rounded-md">
                        <img id="weather-icon">
                    </div>
                    <p class="ml-16 truncate text-2xl font-medium text-gray-500">Location : <span id="weather-city"></span></p>
                    <p class="ml-16 truncate text-2xl font-medium text-gray-500">Local time : <span id="weather-localtime"></span></p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="ml-2 flex items-baseline text-2xl font-semibold ">
                        <span id="weather-current" class="text-green-600"></span><span class="text-green-600">&deg;C.</span>  &nbsp;&nbsp;&nbsp;
                        <span id="weather-condition" class="text-black"></span>
                    </p>

                </dd>
            </div>


        </dl>
    </div>



</div>

<script>
    function getWeather() {
        axios.get('{{ route('get-weather') }}')
            .then(response => {

                const weatherCity = document.getElementById('weather-city');
                const weatherCurrent = document.getElementById('weather-current');
                const weatherLocalTime = document.getElementById('weather-localtime');
                const weatherCondition = document.getElementById('weather-condition');
                const weatherImage = document.getElementById('weather-icon');
                console.log(response.data)

                weatherCity.innerHTML = response.data.location.name;
                weatherLocalTime.innerHTML = response.data.location.localtime.substring(11);
                weatherCurrent.innerHTML = response.data.current.temp_c;
                weatherCondition.innerHTML = response.data.current.condition.text;
                weatherImage.setAttribute('src', response.data.current.condition.icon);

            })
            .catch(error => {
                console.log(error);
                // handle the error here
            });
    }

    window.onload = getWeather;
</script>


