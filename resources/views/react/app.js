import 'babel-polyfill';

import { Provider } from 'react-redux'
import React from 'react';
import { render } from 'react-dom';

import 'bootstrap';

import App from './components/App.js'
import store from './store/store';

render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('app')
);
