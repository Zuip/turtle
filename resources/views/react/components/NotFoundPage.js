import React from 'react';
import { connect } from 'react-redux';

import LoaderSpinner from './LoaderSpinner.js';

class NotFoundPage extends React.Component {

  render() {
    return (
      <div>
        <h2>{this.props.translations.notFound.notFound}</h2>
        <p>{this.props.translations.notFound.resourceDoesNotExist}</p>
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(NotFoundPage);
