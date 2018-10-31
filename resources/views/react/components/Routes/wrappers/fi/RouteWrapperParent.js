import React from 'react';

import setLanguage from '../../../../services/setLanguage';

class RouteWrapperParent extends React.Component {

  constructor(props) {
    super(props);

    this.state = {
      loaded: false
    }

    setLanguage('fi').then(() => {
      this.setState({ loaded: true });
    });
  }
}

export default RouteWrapperParent;