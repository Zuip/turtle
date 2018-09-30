import React from 'react';

import City from '../../../Cities/City';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class CityRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  componentDidMount() {
    setTitle();
  }

  render() {
    return (
      <City match={this.props.match} history={this.props.history} />
    );
  }
}

export default CityRouteWrapper;