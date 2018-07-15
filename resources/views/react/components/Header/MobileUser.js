import React from 'react';
import { connect } from 'react-redux';

class MobileUser extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    if(!this.props.user) {
      return null;
    }

    return (
      <div className="header-element only-in-mobile">
        <h3>
          <i className="fas fa-user-circle"></i>
          {this.props.user.name}
        </h3>
      </div>
    );
  }
}

export default connect(
  state => ({
    user: state.user
  })
)(MobileUser);
