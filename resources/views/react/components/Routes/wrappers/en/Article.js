import React from 'react';
import { connect } from 'react-redux';

import Article from '../../../Articles/Article';
import RouteWrapperParent from './RouteWrapperParent';

class ArticleRouteWrapper extends RouteWrapperParent {
  render() {
    return (
      <Article match={this.props.match} history={this.props.history} />
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticleRouteWrapper);