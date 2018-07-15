import { combineReducers } from 'redux';

import loading from './loading/loading';
import translations from './translations';
import user from './user';

export default combineReducers({
  loading,
  translations,
  user
});
