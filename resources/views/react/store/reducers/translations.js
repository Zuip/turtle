import fi from '../../translations/fi.js';
import {SET_LANGUAGE} from '../actions';

export default function(state = fi, action) {

  if(action.type === SET_LANGUAGE) {
    return action.language;
  }

  return state;
};
