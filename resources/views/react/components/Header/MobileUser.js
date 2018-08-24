import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class MobileUser extends React.Component {

  constructor(props) {
    super(props);
  }

  getProfileLink() {
    return '/' + this.props.translations.routes.users
         + '/' + this.props.user.name.toLowerCase();
  }

  render() {

    if(!this.props.user) {
      return null;
    }

    return (
      <div>
        <Link to={this.getProfileLink()}>
          <div className="header-element only-in-mobile">
            <h3>
              <i className="fas fa-user-circle"></i>
              {this.props.user.name}
            </h3>
          </div>
          </Link>
        <a href="/admin">
          <div className="header-element only-in-mobile">
            <h3>
            <i className="fas fa-cog"></i>
              {this.props.translations.header.admin}
            </h3>
          </div>
        </a>
      </div>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(MobileUser);
