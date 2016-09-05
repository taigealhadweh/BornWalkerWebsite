$.ajax({
    type: "GET",
    url: "https://api.forecast.io/forecast/7be729426ae7b4483f56171d5baa8579/-37.89562,145.02597",
    crossDomain: true,
    dataType: 'jsonp',
    success: function (weatherData) {
        console.log(weatherData);
        //Convert the farenheit temp to celcius with 2 decimal places
        var currentTemperatureCelcius = Math.round((weatherData.currently.apparentTemperature - 32) * (5 / 9) * 100) / 100

        //console.log(currentTemperatureCelcius)
        //Display the current temperature in the table
        $("#currentTemperature").text(currentTemperatureCelcius.toString())

        var hourlyWeatherCelcius = Math.round((weatherData.hourly.data[1].apparentTemperature - 32) * (5 / 9) * 100) / 100

        $("#hourlyWeather").text(hourlyWeatherCelcius).toString()
        $("#")
    }
});



//var currentTimestamp = Math.floor(Date.now() / 1000)
//        var desiredTime = currentTimestamp + 60 * 60
//       var tonightsWeather = null
//        weatherData.hourly.data.forEach(function(currentValue, index, array){
//            if currentValue.time = desiredTimestamp
//              then set tonightsWeather = currentValue
//              break
//        } )


//set time out
//javascript date
//take todays date, figure out 8pm unix timestamp, then find that in the hourly array