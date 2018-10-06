import React from 'react';
import { connect } from 'react-redux';

import City from '../../../Cities/City';
import RouteWrapperParent from './RouteWrapperParent';

class CityRouteWrapper extends RouteWrapperParent {
  render() {
    return (
      <City match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CityRouteWrapper);