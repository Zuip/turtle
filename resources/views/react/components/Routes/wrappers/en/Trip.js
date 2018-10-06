import React from 'react';
import { connect } from 'react-redux';

import TranslationNotFound from '../../../Trips/TranslationNotFound';
import Trip from '../../../Trips/Trip';
import RouteWrapperParent from './RouteWrapperParent';

class TripRouteWrapper extends RouteWrapperParent {
  render() {

    if(!this.state.loaded) {
      return null;
    }

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