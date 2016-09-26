$.ajax({
    type: "GET",
    url: "https://api.forecast.io/forecast/7be729426ae7b4483f56171d5baa8579/-37.89562,145.02597",
    crossDomain: true,
    dataType: 'jsonp',
    success: function (weatherData) {
        console.log(weatherData);
        //Convert the farenheit temp to celcius with 2 decimal places
        var currentTemperatureCelcius = Math.round((weatherData.currently.apparentTemperature - 32) * (5 / 9) * 100) / 100

        
        currentTemperatureCelcius += "℃";
        $("#currentTemperature").text(currentTemperatureCelcius.toString())

        var hourlyWeatherCelcius = Math.round((weatherData.hourly.data[1].apparentTemperature - 32) * (5 / 9) * 100) / 100

        $("#hourlyWeather").text(hourlyWeatherCelcius).toString();
        
        $("#weatherSummary").text(weatherData.currently.summary).toString();
        
        var weatherIcon = weatherData.currently.icon;
        var wiString = iconMapping[weatherIcon];
        //If the string returned by the api doesn't match any entries in the iconMapping, return the default icon
        if (wiString === undefined){
            wiString = iconMapping["default"];
        }
        
        $("#weatherIcon").addClass(wiString);
        
    }
});

var iconMapping = {
    'clear-day': "wi-day-sunny",
    'clear-night': "wi-night-clear",
    'rain': "wi-rain",
    'snow': "wi-snow",
    'sleet': "wi-sleet",
    'wind': "wi-strong-wind",
    'fog': "wi-fog",
    'cloudy': "wi-cloudy",
    'partly-cloudy-day': "wi-day-cloudy",
    'partly-cloudy-night': "wi-night-alt-cloudy",
    'default': "wi-na"
}