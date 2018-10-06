import React from 'react';
import { connect } from 'react-redux';

import About from '../../../About/About';
import RouteWrapperParent from './RouteWrapperParent';

class AboutRouteWrapper extends RouteWrapperParent {
  render() {

    if(!this.state.loaded) {
      return null;
    }

    return (
      <About match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(AboutRouteWrapper);