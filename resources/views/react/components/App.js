import React from 'react';
import { BrowserRouter } from 'react-router-dom'

import Footer from './Footer/Footer';
import Header from './Header/Header';
import InfoBox from './Header/InfoBox';
import Routes from './Routes/Routes';
import SpinnerOverlay from './Overlay/SpinnerOverlay';

class App extends React.Component {

  render() {
    return (
      <BrowserRouter>
        <div id="grid-container">
          <Header />
          <InfoBox />
          <Routes />
          <SpinnerOverlay />
          <Footer />
        </div>
      </BrowserRouter>
    );
  }
}

export default App;
