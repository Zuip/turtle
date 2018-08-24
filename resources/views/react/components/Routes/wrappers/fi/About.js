import React from 'react';

import About from '../../../About/About';
import setLanguage from '../../../../services/setLanguage';

class AboutRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  render() {
    return (
      <About match={this.props.match} history={this.props.history} />
    );
  }
}

export default AboutRouteWrapper;