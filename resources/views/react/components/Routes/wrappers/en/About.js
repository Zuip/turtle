import React from 'react';

import About from '../../../About/About';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class AboutRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  componentDidMount() {
    setTitle();
  }

  render() {
    return (
      <About match={this.props.match} history={this.props.history} />
    );
  }
}

export default AboutRouteWrapper;