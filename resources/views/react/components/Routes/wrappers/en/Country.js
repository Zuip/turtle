import React from 'react';
import { connect } from 'react-redux';

import Country from '../../../Cities/Countries/Country';
import RouteWrapperParent from './RouteWrapperParent';

class CountryRouteWrapper extends RouteWrapperParent {
  render() {
    return (
      <Country match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CountryRouteWrapper);