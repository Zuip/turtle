import { combineReducers } from 'redux';

import loading from './loading/loading';
import translations from './translations';

export default combineReducers({
  loading,
  translations
});
