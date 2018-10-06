import React from 'react';
import { connect } from 'react-redux';

import Profile from '../../../Profile/Profile';
import RouteWrapperParent from './RouteWrapperParent';

class ProfileRouteWrapper extends RouteWrapperParent {
  render() {

    if(!this.state.loaded) {
      return null;
    }

    return (
      <Profile match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ProfileRouteWrapper);