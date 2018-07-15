import React from 'react';
import { connect } from 'react-redux';

class MobileUserMenuToggler extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    if(!this.props.user) {
      return null;
    }

    return (
      <div className="mobile-menu-toggler">
        <i className="fas fa-user-circle" onClick={this.props.toggleMenu}>
        </i>
      </div>
    );
  }
}

export default connect(
  state => ({ user: state.user })
)(MobileUserMenuToggler);
