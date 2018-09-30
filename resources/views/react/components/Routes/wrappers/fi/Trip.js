import React from 'react';

import TranslationNotFound from '../../../Trips/TranslationNotFound';
import Trip from '../../../Trips/Trip';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class TripRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  componentDidMount() {
    setTitle();
  }

  render() {

    if(this.props.match.params.tripUrlName === '404') {
      return (
        <TranslationNotFound match={this.props.match} history={this.props.history} />
      );
    }

    return (
      <Trip match={this.props.match} history={this.props.history} />
    );
  }
}

export default TripRouteWrapper;