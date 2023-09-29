function trackUserLocation() {
    var reqcount = 0;
    var lastLatitude;
    var lastLongitude;

    navigator.geolocation.watchPosition(
        successCallback,
        errorCallback,
        options
    );

    // Retrieve the last recorded location from the database when the page loads
    $.ajax({
        url: "/commercial/commercial/last-location",
        method: "GET",
        success: function (response) {
            if (response && response.latitude && response.longitude) {
                lastLatitude = response.latitude;
                lastLongitude = response.longitude;
            } else {
                console.log("Invalid response received for last location.");
            }
        },
        error: function (error) {
            console.log("Failed to retrieve last location:", error);
        },
    });

    function successCallback(position) {
        const { latitude, longitude } = position.coords;
        // Check if the current location is the same as the last recorded location
        if (
            lastLatitude !== undefined &&
            lastLongitude !== undefined &&
            withinTolerance(latitude, lastLatitude) &&
            withinTolerance(longitude, lastLongitude)
        ) {
            console.log("Same location, no data sent to the database.");
        } else {
            // Save the current location to the database
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
                    console.log("Location updated successfully.");
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
        console.log("Failed to get user's location:", error.message);
    }

    function withinTolerance(value1, value2) {
        var tolerance = 0.01; // Adjust the tolerance value as needed
        return Math.abs(value1 - value2) < tolerance;
    }

    var options = {
        // enableHighAccuracy: false,
        timeout: 5000,
        maximumAge: 6000,
    };
}

// Trigger the function when the page loads
document.addEventListener("DOMContentLoaded", function () {
    // Check if the user has role 0 before tracking their location
    if (userRole === "0") {
        trackUserLocation();
    }
});
