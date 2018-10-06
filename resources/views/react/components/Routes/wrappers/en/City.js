import React from 'react';
import { connect } from 'react-redux';

import City from '../../../Cities/City';
import RouteWrapperParent from './RouteWrapperParent';

class CityRouteWrapper extends RouteWrapperParent {
  render() {

    if(!this.state.loaded) {
      return null;
    }

    return (
      <City match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CityRouteWrapper);