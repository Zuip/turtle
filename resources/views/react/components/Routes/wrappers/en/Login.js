import React from 'react';

import Login from '../../../Login/Login';
import setLanguage from '../../../../services/setLanguage';

class LoginRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  render() {
    return (
      <Login match={this.props.match} history={this.props.history} />
    );
  }
}

export default LoginRouteWrapper;