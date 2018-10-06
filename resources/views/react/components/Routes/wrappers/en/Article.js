import React from 'react';
import { connect } from 'react-redux';

import Article from '../../../Articles/Article';
import RouteWrapperParent from './RouteWrapperParent';

class ArticleRouteWrapper extends RouteWrapperParent {
  render() {

    if(!this.state.loaded) {
      return null;
    }

    return (
      <Article match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticleRouteWrapper);