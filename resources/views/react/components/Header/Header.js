import React from 'react';
import { Link } from 'react-router-dom';

import LanguageDropdown from './LanguageDropdown';
import store from '../../store/store';

class Header extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div id="navigation-header-content">
        <Link to={'/'}>
          <div id="site-name" className="header-element header-link">
            <h1>{store.getState().translations.website.name}</h1>
          </div>
        </Link>
        <Link to={'/cities'}>
          <div className="header-element header-link">
            <h3>Kaupungit</h3>
          </div>
        </Link>
        <Link to={'/about'}>
          <div id="header-about-link" className="header-element header-link">
            <h3>{store.getState().translations.header.about}</h3>
          </div>
        </Link>
        <div className="header-element header-right">
          <button className="form-control header-button">Kirjaudu</button>
        </div>
        <LanguageDropdown />
      </div>
    );
  }
}

export default Header;
