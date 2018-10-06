import React from 'react';
import { connect } from 'react-redux';

import TranslationNotFound from '../../../Articles/TranslationNotFound';
import RouteWrapperParent from './RouteWrapperParent';

class ArticleNotFoundRouteWrapper extends RouteWrapperParent {
  render() {

    if(!this.state.loaded) {
      return null;
    }

    return (
      <TranslationNotFound match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticleNotFoundRouteWrapper);