$.ajax({
    type: "GET",
    url: "https://api.forecast.io/forecast/7be729426ae7b4483f56171d5baa8579/-37.89562,145.02597",
    crossDomain: true,
    dataType: 'jsonp',
    success: function (data) {
        console.log(data)
    }
});
