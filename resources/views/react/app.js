import 'es5-shim';
import 'es6-shim';
import 'whatwg-fetch';

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
