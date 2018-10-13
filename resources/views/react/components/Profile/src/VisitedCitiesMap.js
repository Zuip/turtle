import React from 'react';
import { connect } from 'react-redux';

import VisitedCitiesMap from '../../Cities/VisitedCitiesMap';

class ProfileVisitedCitiesMap extends React.Component {

  render() {

    let visits = [];
    
    this.props.trips.map(
      trip => trip.visits.map(visit => {
        visits.push(visit);
      })
    );

    return (
      <VisitedCitiesMap visits={visits} />
    )
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ProfileVisitedCitiesMap);