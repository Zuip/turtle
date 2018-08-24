import React from 'react';

import Profile from '../../../Profile/Profile';
import setLanguage from '../../../../services/setLanguage';

class ProfileRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  render() {
    return (
      <Profile match={this.props.match} history={this.props.history} />
    );
  }
}

export default ProfileRouteWrapper;