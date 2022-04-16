// API key

// Initialize and add the map
function initMap() {
  // The location of UCF
  const UCF = { lat: 28.602615772531806, lng: -81.20004917340465 };

  // The map, centered at UCF
  const map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: UCF,
  });

  // The marker, positioned at UCF
  const marker = new google.maps.Marker({
    position: UCF,
    map: map,
  });

  map.addListener('click', (mapsMouseEvent) => {
    var newPosition = mapsMouseEvent.latLng;
    var newLat = parseFloat(JSON.stringify(newPosition.lat()));
    var newLng = parseFloat(JSON.stringify(newPosition.lng()));

    document.getElementById('Latitude').value = newLat;
    document.getElementById('Longitude').value = newLng;

    console.log(newLat);
    console.log(newLng);

    marker.setPosition(newPosition);
    marker.setMap(map);
  });
}

window.initMap = initMap;
