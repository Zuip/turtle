import React from 'react';
import { Route, Switch } from 'react-router-dom'

import Slogan from '../FrontPage/Slogan';

class InfoBox extends React.Component {

  render() {
    return (
      <Switch>
        <Route exact component={Slogan} path="/" />
      </Switch>
    );
  }
}

export default InfoBox;
