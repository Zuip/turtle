import React from 'react';
import { connect } from 'react-redux';

import Cities from '../../../Cities/Cities';
import RouteWrapperParent from './RouteWrapperParent';

class CitiesRouteWrapper extends RouteWrapperParent {
  render() {
    return (
      <Cities match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CitiesRouteWrapper);