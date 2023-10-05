function trackUserLocation() {
    var reqcount = 0;
    var lastLatitude;
    var lastLongitude;

    navigator.geolocation.watchPosition(
        successCallback,
        errorCallback,
        options
    );

    // get the last location
    $.ajax({
        url: "/commercial/commercial/last-location",
        method: "GET",
        success: function (response) {
            if (response && response.latitude && response.longitude) {
                lastLatitude = response.latitude;
                lastLongitude = response.longitude;
            } else {
                console.log("Invalid");
            }
        },
        error: function (error) {
            console.log("Error :", error);
        },
    });

    function successCallback(position) {
        const { latitude, longitude } = position.coords;
        // check the localisation if its the same
        if (
            lastLatitude !== undefined &&
            lastLongitude !== undefined &&
            withinTolerance(latitude, lastLatitude) &&
            withinTolerance(longitude, lastLongitude)
        ) {
            console.log("Meme localisation");
        } else {
            // send data to database
            $.ajax({
                url: "/commercial/commercial/location",
                method: "POST",
                data: {
                    latitude: latitude,
                    longitude: longitude,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    console.log("Location modifier");
                    lastLatitude = latitude;
                    lastLongitude = longitude;
                },
                error: function (error) {
                    console.log("Failed to update location:", error);
                },
            });
        }
    }

    function errorCallback(error) {
        console.log("Error :", error.message);
    }

    function withinTolerance(value1, value2) {
        var tolerance = 0.0001; // tolerance de position
        return Math.abs(value1 - value2) < tolerance;
    }

    var options = {
        // enableHighAccuracy: false,
        timeout: 5000,
        maximumAge: 6000,
    };
}

// func trigger
document.addEventListener("DOMContentLoaded", function () {
    if (userRole === "0") {
        trackUserLocation();
    }
});
