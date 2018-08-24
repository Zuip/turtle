import React from 'react';

import Country from '../../../Cities/Countries/Country';
import setLanguage from '../../../../services/setLanguage';

class CountryRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  render() {
    return (
      <Country match={this.props.match} history={this.props.history} />
    );
  }
}

export default CountryRouteWrapper;