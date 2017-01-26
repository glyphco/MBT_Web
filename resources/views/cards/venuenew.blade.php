      <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */

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
        width:400px;

      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }


      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 350px;
        padding: 5px 11px;
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
<div>
  <div class="pac-card" id="pac-card">
    <div>
      <div id="title">Search</div>
    </div>
    <div id="pac-container">
      <input id="pac-input" type="text" placeholder="Enter a Venue">
    </div>
  </div>

    <div id="map"></div>

    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>
<div style="position:relative">
    <table id="address">
      <tr>
        <td class="label">Name</td>
        <td class="wideField" colspan="3"><input class="field"
              id="name" disabled="false"></input></td>
      </tr>
      <tr>
        <td class="label">Street address</td>
        <td class="wideField" colspan="2"><input class="field" id="street_address"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="city"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="state" disabled="true"></input></td>
        <td class="label">Postal code</td>
        <td class="wideField"><input class="field" id="postalcode"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Neighborhood</td>
        <td class="wideField" colspan="3"><input class="field"
              id="neighborhood" disabled="true"></input></td>
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
        <td class="label">google_place_id</td>
        <td class="wideField" colspan="3"><input class="field"
              id="google_place_id" disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Website</td>
        <td class="wideField" colspan="3"><input class="field"
              id="website" disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Phone</td>
        <td class="wideField" colspan="3"><input class="field"
              id="phone" disabled="false"></input></td>
      </tr>
      <tr>
        <td class="label">Email</td>
        <td class="wideField" colspan="3"><input class="field"
              id="email" disabled="false"></input></td>
      </tr>
      <tr>
        <td ></td>
        <td class="wideField" colspan="3"><input type="submit" id="submit" value="Use map first..." disabled="true"></td>
      </tr>
    </table>
    </div>
</div>

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
          neighborhood: 'long_name',
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

        autocomplete.addListener('place_changed', function()
        {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          fillInAddressFromPlace(place);
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
          //marker.setVisible(true);

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
          infowindow.setPosition(place.geometry.location)
          infowindow.open(map);
           marker.setVisible(false);
        });

        map.addListener("click", function (event)
        {
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            var geocoder = new google.maps.Geocoder;

            if (event.placeId) {
              console.log('place:'+event.placeId);
              getPlaceFromID(event.placeId);
            } else {
              console.log('geo:'+event.latLng);
              geocodeLatLng(geocoder, map, event.latLng);
            }

        });

      function getPlaceFromID(place_id) {
        var service = new google.maps.places.PlacesService(map);
        service.getDetails({
          placeId: place_id
        }, function(place, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            fillInAddressFromPlace(place);

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
              map.setZoom(16);  // Why 17? Because it looks good.
            }

            marker.setPosition(place.geometry.location);
            //marker.setVisible(true);

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
          infowindow.setPosition(place.geometry.location)
          infowindow.open(map);
           marker.setVisible(false);
          } else {
            //console.log(status);
          }

        });
      }

      function geocodeLatLng(geocoder, map, latlng) {

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              placename = results[0].formatted_address;
              fillInAddressFromGeo(results[0]);
              document.getElementById('pac-input').value = placename;
            } else {
                window.alert('No results found');
            }
            map.setCenter(results[0].geometry.location);
            if (map.getZoom() < 16) {
              map.setZoom(16);  // Why 16? Because it looks good.
            }

            var address = '';
            if (results[0].address_components) {
              address = [
                (results[0].address_components[0] && results[0].address_components[0].short_name || ''),
                (results[0].address_components[1] && results[0].address_components[1].short_name || ''),
                (results[0].address_components[2] && results[0].address_components[2].short_name || '')
              ].join(' ');
            }

            infowindowContent.children['place-icon'].src = '';
            infowindowContent.children['place-name'].textContent = 'unknown';
            infowindowContent.children['place-address'].textContent = address;
            infowindow.setPosition(results[0].geometry.location)
            infowindow.open(map);
            marker.setVisible(false);
          } else {
          window.alert('Geocoder failed due to: ' + status);
          }
        });
      }


        function fillInAddressFromPlace(result) {
          var lockElements = {
            name,
            street_address,
            city,
            state,
            postalcode,
            lat,
            lng,
            google_place_id,
          };
          var unlockElements = {

            neighborhood,
            website,
            phone,
            email,
            submit
          };
          for (var element in lockElements) {
            document.getElementById(element).value = '';
            document.getElementById(element).disabled = true;
          }

          for (var element in unlockElements) {
            document.getElementById(element).value = '';
            document.getElementById(element).disabled = false;
          }
          document.getElementById('submit').value = 'Submit';
          //console.log(result.address_components);

          var longcomponents=[];
          var shortcomponents=[];
          for (var i = 0; i < result.address_components.length; i++) {
              longcomponents[result.address_components[i]['types'][0]] = result.address_components[i]['long_name'];
              shortcomponents[result.address_components[i]['types'][0]] = result.address_components[i]['short_name'];
          }

          document.getElementById('name').value = coalesce(result.name,'');
          document.getElementById('street_address').value = coalesce(longcomponents.street_number + ' ' + shortcomponents.route),'';
          document.getElementById('city').value = coalesce(longcomponents.locality,'');
          document.getElementById('state').value = coalesce(shortcomponents.administrative_area_level_1,'');
          document.getElementById('postalcode').value = coalesce(shortcomponents.postal_code,'');
          document.getElementById('lat').value = coalesce(result.geometry.location.lat(),'');
          document.getElementById('lng').value = coalesce(result.geometry.location.lng(),'');

          document.getElementById('neighborhood').value = coalesce(longcomponents.neighborhood,'');
          document.getElementById('website').value = coalesce(result.website,'');
          document.getElementById('google_place_id').value = coalesce(result.id,'');
          document.getElementById('phone').value = coalesce(result.phone,'');
          document.getElementById('email').value = coalesce(result.email,'');

        }

      }

      function fillInAddressFromGeo(result) {
          // Get the place details from the autocomplete object.
          //var place = autocomplete.getPlace();
        var lockElements = {
          street_address,
          city,
          state,
          postalcode,
          lat,
          lng,
                    google_place_id,
        };
        var unlockElements = {
          name,
          neighborhood,
          website,
          phone,
          email,
          submit
        };
          for (var element in lockElements) {
            document.getElementById(element).value = '';
            document.getElementById(element).disabled = true;
          }

          for (var element in unlockElements) {
            document.getElementById(element).value = '';
            document.getElementById(element).disabled = false;
          }
          document.getElementById('submit').value = 'Submit';
          //console.log(result.address_components);

          var longcomponents=[];
          var shortcomponents=[];
          for (var i = 0; i < result.address_components.length; i++) {
            longcomponents[result.address_components[i]['types'][0]] = result.address_components[i]['long_name'];
            shortcomponents[result.address_components[i]['types'][0]] = result.address_components[i]['short_name'];
          }

          document.getElementById('street_address').value = '';
          document.getElementById('street_address').value = (longcomponents.street_number + ' ' + shortcomponents.route) || '';
          document.getElementById('city').value = coalesce(longcomponents.locality,'');
          document.getElementById('state').value = coalesce(shortcomponents.administrative_area_level_1,'');
          document.getElementById('postalcode').value = coalesce(shortcomponents.postal_code,'');
          document.getElementById('lat').value = coalesce(result.geometry.location.lat(),'');
          document.getElementById('lng').value = coalesce(result.geometry.location.lng(),'');

          document.getElementById('neighborhood').value = coalesce(longcomponents.neighborhood,'');
          document.getElementById('website').value = '';
          document.getElementById('google_place_id').value = '';
          document.getElementById('phone').value = '';
          document.getElementById('email').value = '';


         }



function coalesce() {
    var len = arguments.length;
    for (var i=0; i<len; i++) {
        if (arguments[i] !== null && arguments[i] !== undefined) {
            return arguments[i];
        }
    }
    return null;
}

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRVje7gRNWDLDu0fBpuSPxMmr4wUrmikc&libraries=places&callback=initMap">
    </script>
