import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class LoginButton extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    if(CONFIG_ENVIRONMENT === 'production') {
      return null;
    }

    if(this.props.user) {
      return null;
    }

    return (
      <div className="header-element header-right">
        <Link to={'/login'} className="btn btn-light header-login-button">
          {this.props.translations.header.login}
        </Link>
      </div>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(LoginButton);
