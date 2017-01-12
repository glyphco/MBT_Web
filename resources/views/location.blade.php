<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
var myLatlng = {lat: 41.91,  lng: -87.66};

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatlng,
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            myLatlng = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            // infoWindow.setPosition(myLatlng);
            // infoWindow.setContent('Location found.');
            map.setCenter(myLatlng);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'you'
        });


        map.addListener('center_changed', function() {
          marker.setPosition(map.getCenter());
          //map.setMapOnAll(null);
          //map.setZoom(8);
          //addMarker(event.latLng);

// marker = new google.maps.Marker({
//           position: location,
//           map: map
//        });

        // var marker = new google.maps.Marker({
        //   position: myLatlng,
        //   map: map,
        //   title: 'you'
        // });
          // map.setCenter(marker.getPosition());
        });

        // map.addListener('center_changed', function() {
        //   // 3 seconds after the center of the map has changed, pan back to the
        //   // marker.
        //   window.setTimeout(function() {
        //     map.addMarker(event.latLng);
        //   }, 500);
        // });

      // Adds a marker to the map and push to the array.


      }

      function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        //dont do anything
        // infoWindow.setPosition(pos);
        // infoWindow.setContent(browserHasGeolocation ?
        //                       'Error: The Geolocation service failed.' :
        //                       'Error: Your browser doesn\'t support geolocation.');
      }


            // Sets the map on all markers in the array.
      // function setMapOnAll(map) {
      //   for (var i = 0; i < markers.length; i++) {
      //     markers[i].setMap(map);
      //   }
      // }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRVje7gRNWDLDu0fBpuSPxMmr4wUrmikc&callback=initMap">
    </script>
  </body>
</html>




