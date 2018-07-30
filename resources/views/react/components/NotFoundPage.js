import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from './Layout/Grids/ArticleLayout';

class NotFoundPage extends React.Component {

  render() {
    return (
      <ArticleLayout>
        <h2>{this.props.translations.notFound.notFound}</h2>
        <p>{this.props.translations.notFound.resourceDoesNotExist}</p>
      </ArticleLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(NotFoundPage);
