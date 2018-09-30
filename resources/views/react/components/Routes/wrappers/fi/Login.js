import React from 'react';

import Login from '../../../Login/Login';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class LoginRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  componentDidMount() {
    setTitle();
  }

  render() {
    return (
      <Login match={this.props.match} history={this.props.history} />
    );
  }
}

export default LoginRouteWrapper;