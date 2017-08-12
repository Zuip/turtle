import React from 'react';
import {render} from 'react-dom';
import {BrowserRouter, Route} from 'react-router-dom'
import 'bootstrap';

import {Header} from './components/Header/Header.js';
import {About} from './components/About/About.js';

render(
  <BrowserRouter>
    <div id="grid-container">
      <div id="navigation-header-color-bar"></div>
      <Header />
      <div id="navigation-content">
            <Route component={About} path="/about" />
      </div>
      <div id="navigation-footer-color-bar"></div>
      <div id="navigation-footer-content"><p>&copy; 2015-2017 Zui.fi</p></div>
    </div>
  </BrowserRouter>,
  document.getElementById('app')
);
