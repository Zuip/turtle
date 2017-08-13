import React from 'react';
import {render} from 'react-dom';
import {BrowserRouter, Route, Switch} from 'react-router-dom'
import 'bootstrap';

import {Header} from './components/Header/Header.js';
import {About} from './components/About/About.js';
import {FrontPage} from './components/FrontPage/FrontPage.js';
import {Article} from './components/Article/Article.js';
import {NotFoundPage} from './components/NotFoundPage.js';

render(
  <BrowserRouter>
    <div id="grid-container">
      <div id="navigation-header-color-bar"></div>
      <Header />
      <div id="navigation-content">
        <Switch>
          <Route exact component={FrontPage} path="/" />
          <Route exact component={About} path="/about" />
          <Route exact component={Article} path="/articles/:articleURLName" />
          <Route component={NotFoundPage} />
        </Switch>
      </div>
      <div id="navigation-footer-color-bar"></div>
      <div id="navigation-footer-content"><p>&copy; 2015-2017 Zui.fi</p></div>
    </div>
  </BrowserRouter>,
  document.getElementById('app')
);
