<!DOCTYPE html>
<html>
<head>
  <title>Nearby Recycling Centers</title>
  <style>
    #map {
      height: 90vh;
      width: 100%;
    }
    body {
      font-family: Arial, sans-serif;
    }
  </style>
</head>
<body>
  <h2 style="text-align: center;">Nearby Recycling Centers</h2>
  <div id="map"></div>

  <script>
    function initMap() {
      // Get user location
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          const map = new google.maps.Map(document.getElementById('map'), {
            center: userLocation,
            zoom: 14
          });

          const userMarker = new google.maps.Marker({
            position: userLocation,
            map: map,
            title: "You are here"
          });

          // 🔍 Search for nearby recycling centers
          const service = new google.maps.places.PlacesService(map);
          service.nearbySearch({
            location: userLocation,
            radius: 5000, // 5 km
            keyword: 'recycling center'
          }, function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
              results.forEach(place => {
                new google.maps.Marker({
                  position: place.geometry.location,
                  map: map,
                  title: place.name
                });
              });
            } else {
              alert("No recycling centers found nearby.");
            }
          });

        }, function() {
          alert("Location access denied.");
        });
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }
  </script>

  <!-- 👇 Replace YOUR_API_KEY -->
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap">
  </script>
</body>
</html>