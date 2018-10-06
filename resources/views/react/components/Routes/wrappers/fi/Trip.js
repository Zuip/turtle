import React from 'react';
import { connect } from 'react-redux';

import RouteWrapperParent from './RouteWrapperParent';
import TranslationNotFound from '../../../Trips/TranslationNotFound';
import Trip from '../../../Trips/Trip';

class TripRouteWrapper extends RouteWrapperParent {
  render() {

    if(this.props.match.params.tripUrlName === '404') {
      return (
        <TranslationNotFound match={this.props.match} history={this.props.history} />
      );
    }

    return (
      <Trip match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(TripRouteWrapper);