<!DOCTYPE html>
<html>
  <head>
    <title>Place details</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      .field {
        width: 99%;
      }
    </style>

  </head>
  <body>
  <div class="pac-card" id="pac-card">
      <div>
        <div id="title">
          Search
        </div>
      </div>
      <div id="pac-container">
        <input id="pac-input" type="text"
            placeholder="Enter a location">
      </div>
    </div>
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>
        <table id="address">
      <tr>
        <td class="label">Name</td>
        <td class="wideField" colspan="3"><input class="field"
              id="name" disabled="false"></input></td>
      </tr>
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <!-- Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        -->
        <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Lat</td>
        <td class="slimField"><input class="field"
              id="lat" disabled="true"></input></td>
        <td class="label">Lng</td>
        <td class="slimField"><input class="field"
              id="lng" disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">website</td>
        <td class="wideField" colspan="3"><input class="field"
              id="website" disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">google_place_id</td>
        <td class="wideField" colspan="3"><input class="field"
              id="google_place_id" disabled="true"></input></td>
      </tr>

    </table>

    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var origin = {lat: 41.94, lng: -87.68};
        var REQUIRED_ZOOM = 15;

        var map = new google.maps.Map(document.getElementById('map'), {
          center: origin,
          zoom: 13
        });

        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        var placeSearch;
        var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(1, 1)
        });





  // map.addListener('click', function(e) {
  //   googleMapClickHandler(e.latLng, map);
  // });

        autocomplete.addListener('place_changed', function() 
        {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          fillInAddress(place);
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        map.addListener("click", function (event) 
        {
            console.log(event);
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            var geocoder = new google.maps.Geocoder;

            console.log( latitude + ', ' + longitude );
            if (event.placeId) {
              console.log(event.placeId);
              console.log('calling ');
              getPlaceFromID(event.placeId);
              console.log('called ');
            } else {
            geocodeLatLng(geocoder, map, event.latLng)
            }

            // radius = new google.maps.Circle({map: map,
            //     radius: 100,
            //     center: event.latLng,
            //     fillColor: '#777',
            //     fillOpacity: 0.1,
            //     strokeColor: '#AA0000',
            //     strokeOpacity: 0.8,
            //     strokeWeight: 2,
            //     draggable: true,    // Dragable
            //     editable: true      // Resizable
            // });

            // Center of map
            map.panTo(event.latLng);
                        console.log('done');
        });

      function getPlaceFromID(place_id) {
        console.log('in placeid');
        var service = new google.maps.places.PlacesService(map);

        service.getDetails({
          placeId: place_id
        }, function(place, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            // var marker = new google.maps.Marker({
            //   map: map,
            //   position: place.geometry.location
            // });
            console.log('here');
            markerOn(place.geometry.location, '<div><strong>' + place.name + '</strong><br>' +
                'Place ID: ' + place.place_id + '<br>' +
                place.formatted_address + '</div>')
                        console.log('here2');
            // marker.setPosition(place.geometry.location);
            // marker.setVisible(true);
            // google.maps.event.addListener(marker, 'click', function() {
            //   infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
            //     'Place ID: ' + place.place_id + '<br>' +
            //     place.formatted_address + '</div>');
            //   infowindow.open(map, this);
            // });
            
            fillInAddress(place);
          }
        });
      }

      function markerOff() {
        marker.setVisible(false);
      }

      function markerOn(location, info) {            
        marker.setPosition(location);
        marker.setVisible(true);
        infowindow.setContent(info);
        infowindow.open(map, marker);
      }

  function geocodeLatLng(geocoder, map, latlng) {
        console.log('in geo coder');
    // var input = document.getElementById('latlng').value;
    // var latlngStr = input.split(',', 2);
    // var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          markerOff();

           placename = results[0].formatted_address;
//            if (results[0].place_id) {
// getPlaceFromID(results[0].place_id);
//            }
           //          marker.setVisible(false);
            //map.setZoom(15);
            // var marker = new google.maps.Marker({
            // position: latlng,
            // map: map
            // });
            // infowindow.setContent(results[0].formatted_address);
            // infowindow.open(map, marker);
//           document.getElementById("place_input").value =  placename;

 markerOn(latlng, placename);

console.log(results[0]);
document.getElementById('pac-input').value = placename;
        } else {
            window.alert('No results found');
        }
        } else {
        window.alert('Geocoder failed due to: ' + status);
        }
    });
    }

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          // var radioButton = document.getElementById(id);
          // radioButton.addEventListener('click', function() {
          //   autocomplete.setTypes(types);
          // });
        }

        function fillInAddress(place) {
          // Get the place details from the autocomplete object.
          //var place = autocomplete.getPlace();
          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }

          // Get each component of the address from the place details
          // and fill the corresponding field on the form.
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType).value = val;
            }
          }

          document.getElementById('name').value = place.name;
          document.getElementById('lat').value = place.geometry.location.lat();
          document.getElementById('lng').value = place.geometry.location.lng();
          document.getElementById('website').value = place.website;
          document.getElementById('google_place_id').value = place.id;
        }

        // setupClickListener('changetype-all', []);
        // setupClickListener('changetype-address', ['address']);
        // setupClickListener('changetype-establishment', ['establishment']);
        // setupClickListener('changetype-geocode', ['geocode']);

        // document.getElementById('use-strict-bounds')
        //     .addEventListener('click', function() {
        //       console.log('Checkbox clicked! New state=' + this.checked);
        //       autocomplete.setOptions({strictBounds: this.checked});
        //     });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRVje7gRNWDLDu0fBpuSPxMmr4wUrmikc&libraries=places&callback=initMap">
    </script>
  </body>
</html>