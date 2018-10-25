import React from 'react';
import { Router } from 'react-router-dom'

import Footer from './Footer/Footer';
import getCurrentUser from '../apiCalls/users/getCurrentUser';
import googleAnalytics from '../services/googleAnalytics';
import Header from './Header/Header';
import InfoBox from './Header/InfoBox';
import Routes from './Routes/Routes';
import setCurrentUser from '../services/setCurrentUser';
import SpinnerOverlay from './Overlay/SpinnerOverlay';
import logError from '../services/logError';

class App extends React.Component {

  componentDidMount() {
    getCurrentUser().then(
      user => setCurrentUser(user)
    ).catch(
      error => logError(error, 'components/App.js')
    );
  }

  render() {
    return (
      <Router history={googleAnalytics}>
        <div id="grid-container">
          <Header />
          <InfoBox />
          <Routes />
          <SpinnerOverlay />
          <Footer />
        </div>
      </Router>
    );
  }
}

export default App;
