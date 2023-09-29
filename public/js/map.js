document.addEventListener("DOMContentLoaded", function () {
    if (positions.length > 0) {
        // Create map
        var map = L.map("map").setView(
            [positions[0].latitude, positions[0].longitude],
            13
        );

        // Add tile layer to the map
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors",
        }).addTo(map);

        // Create an array to store marker coordinates
        var markerCoordinates = [];

        // Loop through the positions and create markers
        for (var i = 0; i < positions.length; i++) {
            var position = positions[i];
            var marker = L.marker([
                position.latitude,
                position.longitude,
            ]).addTo(map);

            marker.bindPopup(i + 1 + "eme position").openPopup();
            // Check if it's the last position
            if (i === positions.length - 1) {
                // Add special popup for the last position
                marker.bindPopup("Dernière position").openPopup();
            }
            // Add coordinates to the markerCoordinates array
            markerCoordinates.push([position.latitude, position.longitude]);
        }

        // Assuming you have two marker objects: marker1 and marker2
        var timestamp1 = new Date(position.created_at).getTime();
        var timestamp2 = new Date(position.created_at).getTime();

        // Calculate the time difference in milliseconds
        var timeDiff = Math.abs(timestamp2 - timestamp1);

        // Convert the time difference to a readable format
        var hours = Math.floor(timeDiff / (1000 * 60 * 60));
        var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

        // Create a polyline from the marker coordinates
        var polyline = L.polyline(markerCoordinates, { color: "black" })
            .bindPopup(hours + "h " + minutes + "m " + seconds + "s")
            .addTo(map);
    } else {
        // Display a message if no positions are available
        document.getElementById("map").innerHTML =
            "Pas de positions disponibles";
    }
});
