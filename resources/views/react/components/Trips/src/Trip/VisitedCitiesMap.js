import React from 'react';
import { connect } from 'react-redux';

import VisitedCitiesMap from '../../../Cities/VisitedCitiesMap';

class TripVisitedCitiesMap extends React.Component {

  render() {
    return (
      <VisitedCitiesMap visits={this.props.trip.visits} />
    )
  }
}

export default connect(
  state => ({ translations: state.translations })
)(TripVisitedCitiesMap);