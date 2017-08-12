import React from 'react';
import {render} from 'react-dom';
import { BrowserRouter, Route, Link } from 'react-router-dom';
class Header extends React.Component {

  render() {
    return (
      <div id="navigation-header-content">
        <Link to={'/'}>
          <div id="site-name" className="header-element">
            <h1>Zui.fi</h1>
          </div>
        </Link>
        <div className="header-element">
          <h3>Matkat</h3>
          <div id="header-travels-menu"></div>
        </div>
        <Link to={'/about'}>
          <div id="header-about-link" className="header-element">
            <h3>Kirjoittaja</h3>
          </div>
        </Link>
      </div>
    );
  }
}

export {Header};
