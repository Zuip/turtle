import React from 'react';
import store from '../../store/store';

class Footer extends React.Component {

  render() {
    return (
      <div id="navigation-footer-content">
        <p>&copy; 2018 {store.getState().translations.website.name}</p>
      </div>
    );
  }
}

export default Footer;
