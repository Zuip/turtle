import React from 'react';

import City from '../../../Cities/City';
import setLanguage from '../../../../services/setLanguage';

class CityRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  render() {
    return (
      <City match={this.props.match} history={this.props.history} />
    );
  }
}

export default CityRouteWrapper;