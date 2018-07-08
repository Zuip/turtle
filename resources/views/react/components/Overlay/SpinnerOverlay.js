import React from 'react';
import { connect } from 'react-redux';

import Overlay from './Overlay';

class SpinnerOverlay extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    if(this.props.loading.page.length === 0) {
      return null;
    }

    let spinner = <i id="spinner-icon" className="fas fa-spinner fa-spin"></i>;

    return (
      <Overlay content={spinner} />
    );
  }
}

export default connect(
  state => ({ loading: state.loading })
)(SpinnerOverlay);
