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


const weatherCityFuture = document.getElementById('weather-city-future');
const weatherCurrentFuture = document.getElementById('weather-current-future');


const weatherImageFuture = document.getElementById('weather-icon-future');
const weatherWindFuture = document.getElementById('weather-wind-future');
const weatherSunsetFuture = document.getElementById('weather-sunset-future');
const weatherSunriseFuture = document.getElementById('weather-sunrise-future');

const inputElement = document.getElementById('place');
const getWeatherLocationRoute = "api/get-weather-location";
const getWeatherLocationRouteFuture = "api/get-weather-location-future";
const getWeatherRoute = 'api/get-weather';
const getWeatherRouteFuture = 'api/get-weather-future';


/**
 * onload
 * @type {getWeather}
 */
window.onload = function() {
    getNews();
    getWeather();
    getWeatherFuture();
}

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

    axios.post(getWeatherLocationRouteFuture, { city: selectedLocation })
        .then(response => {
            updateWeatherFuture(response);
        })
        .catch(error => {
            console.log(error);
        });
    getNews();
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
    axios.post(getWeatherLocationRouteFuture, { city: selectedLocation })
        .then(response => {
            updateWeatherFuture(response);
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
            console.log(getWeatherRoute)
            updateWeather(response);
        })
        .catch(error => {
            console.log(error);
            // handle the error here
        });
}

function getWeatherFuture() {

    let selectedLocation = "Aveiro";
    axios.post(getWeatherRouteFuture ,{ city: selectedLocation })
        .then(response => {
            updateWeatherFuture(response);
        })
        .catch(error => {
            console.log(error);
            // handle the error here
        });
}

function updateWeather(response) {

    weatherCity.innerHTML = response.data.location.name.substring(0,20);
    weatherLocalTime.innerHTML = response.data.location.localtime.substring(11);
    weatherCurrent.innerHTML = response.data.current.temp_c;
    weatherCondition.innerHTML = response.data.current.condition.text;
    weatherWindDir.innerHTML = response.data.current.wind_dir;
    weatherWind.innerHTML = response.data.current.wind_kph;
    weatherImage.setAttribute('src', response.data.current.condition.icon);

}

function updateWeatherFuture(response) {

    weatherCityFuture.innerHTML = response.data.location.name.substring(0,20);
    weatherCurrentFuture.innerHTML = response.data.forecast.forecastday[0].day.maxtemp_c;
    weatherWindFuture.innerHTML = response.data.forecast.forecastday[0].day.maxwind_kph;
    weatherSunsetFuture.innerHTML = response.data.forecast.forecastday[0].astro.sunset;
    weatherSunriseFuture.innerHTML = response.data.forecast.forecastday[0].astro.sunrise;

    weatherImageFuture.setAttribute('src', response.data.forecast.forecastday[0].day.condition.icon);
}


//////////////////////////////////////// NEWS /////////////////////////////////////
const news = document.getElementById('news');

const getNewsRoute = 'api/get-news';




function getNews() {

    try {
        axios.get(getNewsRoute)
            .then(response => {
                const results = response.data.results;
                const maxSize = results.length;

                if (maxSize === 0) {
                    news.innerHTML = 'No news';
                }
                let i = Math.floor(Math.random() * 4);
                const f = Math.floor(Math.random() * maxSize);
                if (i === f) {
                    i++;
                }

                const newsTitleI = results[i].title;
                const decodedTitle = document.createElement('div');
                decodedTitle.innerHTML = newsTitleI;
                const newsLinkI = results[i].link;
                const newsItemI = document.createElement('a');
                const newsTitleItemI = document.createElement('p');
                newsItemI.href = newsLinkI;
                newsItemI.target = "_blank";
                newsTitleItemI.innerText = decodedTitle.innerText;
                newsItemI.appendChild(newsTitleItemI);
                news.appendChild(newsItemI);

                const newsTitleF = results[f].title;
                const newsLinkF = results[f].link;
                const newsItemF = document.createElement('a');
                const newsTitleItemF = document.createElement('p');
                newsTitleItemF.style.padding = "2px";
                newsTitleItemF.style.margin = "2px";
                newsItemF.href = newsLinkF;
                newsItemF.target = "_blank";
                newsTitleItemF.innerText = newsTitleF;
                newsItemF.appendChild(newsTitleItemF);
                news.appendChild(newsItemF);

            })
            .catch(error => {
                console.log(error);
                // handle the error here
            });
    }catch (e){

    }

}

