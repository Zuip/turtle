import React from 'react';
import { Link } from 'react-router-dom';

import store from '../../store/store';

class Header extends React.Component {

  render() {
    return (
      <div id="navigation-header-content">
        <Link to={'/'}>
          <div id="site-name" className="header-element">
            <h1>{store.getState().translations.website.name}</h1>
          </div>
        </Link>
        <Link to={'/about'}>
          <div id="header-about-link" className="header-element">
            <h3>{store.getState().translations.header.about}</h3>
          </div>
        </Link>
      </div>
    );
  }
}

export default Header;
