import React from 'react';
import { Route, Switch } from 'react-router-dom'

import FrontPage from '../FrontPage/FrontPage';
import NotFoundPage from '../NotFoundPage';

import EN_About from './wrappers/en/About';
import EN_Article from './wrappers/en/Article';
import EN_ArticleNotFound from './wrappers/en/ArticleNotFound';
import EN_Cities from './wrappers/en/Cities';
import EN_City from './wrappers/en/City';
import EN_Country from './wrappers/en/Country';
import EN_Login from './wrappers/en/Login';
import EN_Profile from './wrappers/en/Profile';
import EN_Trip from './wrappers/en/Trip';

import FI_About from './wrappers/fi/About';
import FI_Article from './wrappers/fi/Article';
import FI_ArticleNotFound from './wrappers/fi/ArticleNotFound';
import FI_Cities from './wrappers/fi/Cities';
import FI_City from './wrappers/fi/City';
import FI_Country from './wrappers/fi/Country';
import FI_Login from './wrappers/fi/Login';
import FI_Profile from './wrappers/fi/Profile';
import FI_Trip from './wrappers/fi/Trip';

class Routes extends React.Component {

  render() {
    return (
      <div id="navigation-content">
        <Switch>
          <Route exact component={FrontPage} path="/" />

          <Route exact component={EN_About} path="/about" />
          <Route exact component={EN_Article} path="/trips/:tripURLName/:countryUrlName/:cityUrlName/:cityVisitIndex/article" />
          <Route exact component={EN_ArticleNotFound} path="/article/404" />
          <Route exact component={EN_Cities} path="/cities" />
          <Route exact component={EN_City} path="/countries/:countryUrlName/cities/:cityUrlName" />
          <Route exact component={EN_Country} path="/countries/:countryUrlName" />
          <Route exact component={EN_Login} path="/login" />
          <Route exact component={EN_Profile} path="/users/:user" />
          <Route exact component={EN_Trip} path="/trips/:tripUrlName" />

          <Route exact component={FI_About} path="/tietoa" />
          <Route exact component={FI_Article} path="/matkat/:tripURLName/:countryUrlName/:cityUrlName/:cityVisitIndex/artikkeli" />
          <Route exact component={EN_ArticleNotFound} path="/artikkeli/404" />
          <Route exact component={FI_Cities} path="/kaupungit" />
          <Route exact component={FI_City} path="/maat/:countryUrlName/kaupungit/:cityUrlName" />
          <Route exact component={FI_Country} path="/maat/:countryUrlName" />
          <Route exact component={FI_Login} path="/kirjaudu" />
          <Route exact component={FI_Profile} path="/kayttajat/:user" />
          <Route exact component={FI_Trip} path="/matkat/:tripUrlName" />

          <Route component={NotFoundPage} />
        </Switch>
      </div>
    );
  }
}

export default Routes;
