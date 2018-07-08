import React from 'react';
import { connect } from 'react-redux';

import store from '../../store/store';

class Slogan extends React.Component {
  render() {
    return (
      <div id="frontpage-slogan">
        <h1>{this.props.translations.frontPage.slogan}</h1>
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Slogan);
