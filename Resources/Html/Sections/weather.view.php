<div id="weather">
    <h3 class="text-lg font-bold leading-6">Weather Forecast</h3>
    <div class="mt-5 overflow-x-auto flex">
        <div class="flex items-center justify-center gap-x-3">
            <div v-for="forecast in forecasts" :key="forecast.dt_txt" class="flex flex-col bg-white rounded p-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 max-w-xs">
                <div class="text-sm text-gray-500">{{ forecast.dt_txt }}</div>
                <div class="mt-6 text-6xl self-center inline-flex items-center justify-center rounded-lg text-indigo-400 h-24 w-24">
                    <img :src=`https://openweathermap.org/img/wn/${forecast.weather[0].icon}@2x.png` :alt="forecast.weather[0].description"/>
                </div>
                <div class="flex flex-row items-center justify-center mt-6">
                    <div class="font-medium text-6xl">{{ forecast.main.temp }}</div>
                    <div class="flex flex-col items-center ml-6">
                        <div>{{ forecast.weather[0].main }}</div>
                        <div class="mt-1">
                            <span class="text-sm"><i class="far fa-long-arrow-up"></i></span>
                            <span class="text-sm font-light text-gray-500">{{ forecast.main.temp_max }}</span>
                        </div>
                        <div>
                            <span class="text-sm"><i class="far fa-long-arrow-down"></i></span>
                            <span class="text-sm font-light text-gray-500">{{ forecast.main.temp_min }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row justify-between mt-6">
                    <div class="flex flex-col items-center">
                        <div class="font-medium text-sm">Wind</div>
                        <div class="text-sm text-gray-500">{{ forecast.wind.speed }}</div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="font-medium text-sm">Humidity</div>
                        <div class="text-sm text-gray-500">{{ forecast.main.humidity }}</div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="font-medium text-sm">Visibility</div>
                        <div class="text-sm text-gray-500">{{ forecast.visibility }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    createApp({
        data() {
            return {
                forecasts: [],
            }
        },
        mounted() {
            navigator.geolocation.getCurrentPosition(
                position => axios.get(`/weather?latitude=${position.coords.latitude}&longitude=${position.coords.longitude}`)
                    .then(response => {
                        this.forecasts = response.data;
                    })
                    .catch(error => console.log(error)),
                error => console.warn(`ERROR(${error.code}): ${error.message}`),
                {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0,
                }
            );
        }
    }).mount('#weather')
</script>