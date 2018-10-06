import React from 'react';
import { connect } from 'react-redux';

import Login from '../../../Login/Login';
import RouteWrapperParent from './RouteWrapperParent';

class LoginRouteWrapper extends RouteWrapperParent {
  render() {
    return (
      <Login match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(LoginRouteWrapper);