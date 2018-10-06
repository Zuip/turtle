import React from 'react';

import setDescription from '../../../../services/setDescription';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

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

  componentDidMount() {
    setDescription('Turtle.travel: ' + this.props.translations.slogan);
    setTitle();
  }
}

export default RouteWrapperParent;