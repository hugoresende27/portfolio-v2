/**
 * vars const
 * @type {HTMLElement}
 */
const weatherCity = document.getElementById('weather-city');
const weatherCurrent = document.getElementById('weather-current');
const weatherLocalTime = document.getElementById('weather-localtime');
const weatherCondition = document.getElementById('weather-condition');
const weatherImage = document.getElementById('weather-icon');
const weatherWind = document.getElementById('weather-wind');
const weatherWindDir = document.getElementById('weather-wind-dir');
const selectElement = document.getElementById('location');
const inputElement = document.getElementById('place');
const getWeatherLocationRoute = "api/get-weather-location";
const getWeatherRoute = 'api/get-weather';
/**
 * onload
 * @type {getWeather}
 */
window.onload = getWeather;


/**
 * EventListener
 */
selectElement.addEventListener('change', (event) => {
    const selectedLocation = selectElement.value;


    axios.post(getWeatherLocationRoute, { location: selectedLocation })
        .then(response => {
            updateWeather(response);
        })
        .catch(error => {
            console.log(error);
        });
});

inputElement.addEventListener('keypress', async function (event) {

    const selectedLocation = inputElement.value;
    axios.post(getWeatherLocationRoute, { location: selectedLocation })
        .then(response => {
            updateWeather(response);
        })
        .catch(error => {
            console.log(error);
        });
});

/**
 * funtions
 */
function getWeather() {

    axios.get(getWeatherRoute)
        .then(response => {
            updateWeather(response);
        })
        .catch(error => {
            console.log(error);
            // handle the error here
        });
}

function updateWeather(response) {
    weatherCity.innerHTML = response.data.location.name;
    weatherLocalTime.innerHTML = response.data.location.localtime.substring(11);
    weatherCurrent.innerHTML = response.data.current.temp_c;
    weatherCondition.innerHTML = response.data.current.condition.text;
    weatherWindDir.innerHTML = response.data.current.wind_dir;
    weatherWind.innerHTML = response.data.current.wind_kph;
    weatherImage.setAttribute('src', response.data.current.condition.icon);
}
