class About extends React.Component {

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

  componentDidMount() {
    this.getVisitedPlaces();
  }

  render() {
    return (
      <div>
        <h1>{Language.translations.about.topic}</h1>
        <p>{Language.translations.about.aboutWriter}</p>
        <h3>{Language.translations.about.contact}</h3>
        <p>{Language.translations.about.contactInfo}</p>
        <p>{Language.translations.about.contactEmail}</p>
        <h3>{Language.translations.about.placesVisited}</h3>
        <div id="map"></div>
      </div>
    );
  }
}

ReactDOM.render(
  <About />,
  document.getElementById('AboutView')
);
