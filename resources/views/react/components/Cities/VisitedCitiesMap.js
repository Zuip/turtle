import GoogleMapReact from 'google-map-react';
import React from 'react';
import { connect } from 'react-redux';

import CityVisitPointer from './src/visitedCitiesMap/CityVisitPointer';
import getMapCityPointerData from '../../services/cities/getMapCityPointerData';
import VisitedCitiesMapStyle from '../../style/components/Trips/VisitedCitiesMap';

class VisitedCitiesMap extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      zoom: 1
    };
  }

  getCityPointer(rawCoordinates, visits) {
    
    let coordinates = JSON.parse(rawCoordinates);

    let key = (
      'lat_' + coordinates.latitude
      + '_lng_' + coordinates.longitude
    );
    
    return (
      <CityVisitPointer
        key={key}
        lat={coordinates.latitude}
        lng={coordinates.longitude}
        city={visits[0].city}
      />
    );
  }

  getCityPointers(cityPointers) {

    let ret = [];

    cityPointers.forEach((visits, coordinates) => {
      ret.push(this.getCityPointer(coordinates, visits));
    });

    return ret;
  }

  getDefaultCenter(cityPointers) {

    let defaultCenter = JSON.parse(
      cityPointers.keys().next().value
    );

    return {
      lat: defaultCenter.latitude,
      lng: defaultCenter.longitude
    };
  }

  render() {

    let cityPointers = getMapCityPointerData(this.props.visits);

    if(cityPointers.length === 0) {
      return null;
    }

    return (
      <div style={VisitedCitiesMapStyle}>

        <GoogleMapReact
          bootstrapURLKeys={{ key: CONFIG_GOOGLE_MAPS_KEY }}
          defaultCenter={this.getDefaultCenter(cityPointers)}
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