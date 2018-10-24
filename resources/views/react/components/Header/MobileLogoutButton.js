import React from 'react';
import { connect } from 'react-redux';

import logError from '../../services/logError';
import postLogout from '../../apiCalls/users/postLogout';
import setCurrentUser from '../../services/setCurrentUser';

class MobileLogoutButton extends React.Component {

  constructor(props) {
    super(props);
  }

  logout() {
    postLogout().then(
      () => setCurrentUser(null)
    ).catch(
      error => logError(error)
    );
  }

  render() {

    if(!this.props.user) {
      return null;
    }

    return (
      <div className="header-element only-in-mobile">
        <button className="btn btn-light header-logout-button"
                onClick={this.logout.bind(this)}>

          {this.props.translations.header.logout}

        </button>
      </div>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(MobileLogoutButton);
