import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom'

import About from './About/About';
import Article from './Article/Article';
import Category from './Category/Category';
import CategoryFirstPage from './Category/CategoryFirstPage';
import Footer from './Footer/Footer';
import FrontPage from './FrontPage/FrontPage';
import Header from './Header/Header';
import NotFoundPage from './NotFoundPage';
import Slogan from './FrontPage/Slogan';

class App extends React.Component {

  render() {
    return (
      <BrowserRouter>
        <div id="grid-container">
          <div id="navigation-header-color-bar"></div>
          <Header />
          <Switch>
            <Route exact component={Slogan} path="/" />
          </Switch>
          <div id="navigation-content">
            <Switch>
              <Route exact component={FrontPage} path="/" />
              <Route exact component={About} path="/about" />
              <Route exact component={Article} path="/articles/:articleURLName" />
              <Route exact component={CategoryFirstPage} path="/categories/:categoryURLName" />
              <Route exact component={Category} path="/categories/:categoryURLName/pages/:page" />
              <Route component={NotFoundPage} />
            </Switch>
          </div>
          <Footer />
        </div>
      </BrowserRouter>
    );
  }
}

export default App;
