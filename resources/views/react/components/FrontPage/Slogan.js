import React from 'react';

import store from '../../store/store';

class Slogan extends React.Component {
  render() {
    return (
      <div id="frontpage-slogan">
        <h1>{store.getState().translations.frontPage.slogan}</h1>
      </div>
    );
  }
}

export default Slogan;
