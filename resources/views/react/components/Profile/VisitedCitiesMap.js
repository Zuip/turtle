import React from 'react';
import { connect } from 'react-redux';

import GoogleMapReact from 'google-map-react';
import CityVisitPointer from './CityVisitPointer';
import VisitedCitiesMapStyle from '../../style/components/Trips/VisitedCitiesMap';

class VisitedCitiesMap extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      zoom: 1
    };
  }

  getCityPointersData() {

    let pointersMap = new Map();

    this.props.trips.map(
      trip => trip.visits.map(visit => {

        if(visit.city.latitude !== null && visit.city.longitude !== null) {

          let latitude = pointersMap.get(visit.city.latitude);

          if(typeof latitude === 'undefined') {
            pointersMap.set(
              parseFloat(visit.city.latitude),
              [parseFloat(visit.city.longitude)]
            );
          } else if(!latitude.includes(visit.city.longitude)) {
            latitude.push(parseFloat(visit.city.longitude));
          }
        }
      })
    );

    let pointers = [];

    pointersMap.forEach((longitudes, latitude) => {
      longitudes.map(longitude => {
        pointers.push({
          latitude,
          longitude
        });
      });
    });

    return pointers;
  }

  getCityPointers(cityPointers) {
    return cityPointers.map(cityPointer => (
      <CityVisitPointer
        key={'lat_' + cityPointer.latitude + '_lng_' + cityPointer.longitude}
        lat={cityPointer.latitude}
        lng={cityPointer.longitude}
      />
    ));
  }

  render() {

    let cityPointers = this.getCityPointersData();

    if(cityPointers.length === 0) {
      return null;
    }

    return (
      <div style={VisitedCitiesMapStyle}>

        <GoogleMapReact
          bootstrapURLKeys={{ key: CONFIG_GOOGLE_MAPS_KEY }}
          defaultCenter={{
            lat: cityPointers[0].latitude,
            lng: cityPointers[0].longitude
          }}
          defaultZoom={this.state.zoom}
        >

          {this.getCityPointers(cityPointers)}

        </GoogleMapReact>

      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(VisitedCitiesMap);