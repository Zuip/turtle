import React from 'react';
import ReactToolTip from 'react-tooltip-lite';

import VisitedCitiesMapStyle from '../../../../style/components/Trips/VisitedCitiesMap';

class CityVisitPointer extends React.Component {
  render() {
    return (
      <div style={VisitedCitiesMapStyle.tooltip}>
        <ReactToolTip
          background={VisitedCitiesMapStyle.tooltip.element.backgroundColor}
          color={VisitedCitiesMapStyle.tooltip.element.color}
          content={this.props.city.name}
        >

          <div
            key="city-pointer"
            style={VisitedCitiesMapStyle.pointer}
          />

        </ReactToolTip>
      </div>
    );
  }
}

export default CityVisitPointer;