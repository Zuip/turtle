import React from 'react';
import { BrowserRouter } from 'react-router-dom'

import Footer from './Footer/Footer';
import getCurrentUser from '../apiCalls/getCurrentUser';
import Header from './Header/Header';
import InfoBox from './Header/InfoBox';
import Routes from './Routes/Routes';
import setCurrentUser from '../services/setCurrentUser';
import SpinnerOverlay from './Overlay/SpinnerOverlay';

class App extends React.Component {

  componentDidMount() {
    getCurrentUser().then(
      user => setCurrentUser(user)
    ).catch(
      error => console.log(error)
    );
  }

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
