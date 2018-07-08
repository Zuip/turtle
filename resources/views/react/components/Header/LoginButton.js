import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class LoginButton extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="header-element header-right header-button">
        <button className="form-control header-button">
          {this.props.translations.header.login}
        </button>
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(LoginButton);
