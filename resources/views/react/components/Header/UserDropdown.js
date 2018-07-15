import React from 'react';
import { connect } from 'react-redux';

import postLogout from '../../apiCalls/postLogout';
import setCurrentUser from '../../services/setCurrentUser';

class UserDropdown extends React.Component {

  constructor(props) {
    super(props);
  }

  logout() {
    postLogout().then(
      () => setCurrentUser(null)
    ).catch(
      error => console.log(error)
    );
  }

  render() {

    if(!this.props.user) {
      return null;
    }

    return (
      <div className="dropdown header-right">
        <button className="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i className="fas fa-user-circle"></i>
          <span className="dropdown-toggle-text">{this.props.user.name}</span>
        </button>
        <div className="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown-menu">
          <button className="dropdown-item"
                  type="button"
                  onClick={this.logout.bind(this)}>

            <i className="fas fa-power-off"></i>
            {this.props.translations.header.logout}

          </button>
        </div>
      </div>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(UserDropdown);
