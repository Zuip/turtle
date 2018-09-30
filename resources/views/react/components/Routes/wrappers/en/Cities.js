import React from 'react';

import Cities from '../../../Cities/Cities';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class CitiesRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  componentDidMount() {
    setTitle();
  }

  render() {
    return (
      <Cities match={this.props.match} history={this.props.history} />
    );
  }
}

export default CitiesRouteWrapper;