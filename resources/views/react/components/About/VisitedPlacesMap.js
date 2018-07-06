import React from 'react';

class VisitedPlacesMap extends React.Component {

  getVisitedPlaces() {

    var map = new google.maps.Map(
      document.getElementById('map'), {
        zoom: 3,
        center: {lat: 45, lng: 23}
      }
    );

    fetch('/api/visitedplaces')
    .then(response => response.json())
    .then(json => {
      this.addMarkersToMap(map, json.visitedPlaces);
    });
  }

  addMarkersToMap(map, markers) {
    for(var i in markers) {
      new google.maps.Marker({
        position : {
          lat : markers[i].lat,
          lng : markers[i].lng
        },
        icon : 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
        map : map
      });
    }
  }

  componentDidMount() {
    this.getVisitedPlaces();
  }

  render() {
    return(
      <div>
        <div id="map"></div>
      </div>
    );
  }
}

export default VisitedPlacesMap;
