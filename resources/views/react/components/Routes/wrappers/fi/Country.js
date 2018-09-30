import React from 'react';

import Country from '../../../Cities/Countries/Country';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class CountryRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  componentDidMount() {
    setTitle();
  }

  render() {
    return (
      <Country match={this.props.match} history={this.props.history} />
    );
  }
}

export default CountryRouteWrapper;