import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import BaseLayout from '../Layout/Grids/BaseLayout';

class TranslationNotFound extends React.Component {

  constructor(props) {
    super(props);
  }

  componentDidUpdate(previousProps) {
    if(previousProps.translations.language !== this.props.translations.language) {
      this.props.history.push(
        '/' + this.props.translations.routes.trips
        + '/404'
      );
    }
  }

  render() {
    return (
      <BaseLayout>
        <ArticleLayout>
          <h1>{this.props.translations.notFound.notFound}</h1>
          <p>{this.props.translations.trips.translationNotFound}</p>
        </ArticleLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(TranslationNotFound);