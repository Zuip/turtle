import React from 'react';

import VisitedCitiesMapStyle from '../../style/components/Trips/VisitedCitiesMap';

class CityVisitPointer extends React.Component {

  render() {
    return (
      <div style={VisitedCitiesMapStyle.pointer} />
    );
  }
}

export default CityVisitPointer;