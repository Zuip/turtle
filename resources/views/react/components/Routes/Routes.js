import React from 'react';
import { Route, Switch } from 'react-router-dom'

import About from '../About/About';
import Article from '../Articles/Article';
import City from '../Cities/City';
import Country from '../Cities/Countries/Country';
import FrontPage from '../FrontPage/FrontPage';
import Login from '../Login/Login';
import Profile from '../Profile/Profile';
import Trip from '../Trips/Trip';
import NotFoundPage from '../NotFoundPage';

class Routes extends React.Component {

  render() {
    return (
      <div id="navigation-content">
        <Switch>
          <Route exact component={FrontPage} path="/" />
          <Route exact component={About} path="/about" />
          <Route exact component={Article} path="/trips/:tripURLName/:countryUrlName/:cityUrlName/:cityVisitIndex/article" />
          <Route exact component={City} path="/countries/:countryUrlName/cities/:cityUrlName" />
          <Route exact component={Country} path="/countries/:countryUrlName" />
          <Route exact component={Login} path="/login" />
          <Route exact component={Profile} path="/profile" />
          <Route exact component={Profile} path="/profile/:user" />
          <Route exact component={Trip} path="/trips/:tripUrlName" />
          <Route component={NotFoundPage} />
        </Switch>
      </div>
    );
  }
}

export default Routes;
