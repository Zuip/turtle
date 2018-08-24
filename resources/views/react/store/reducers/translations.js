import en from '../../translations/en/en.js';
import fi from '../../translations/fi/fi.js';
import {SET_LANGUAGE} from '../actions';

let defaultLanguage = en;
if(CONFIG_BROWSER_LANGUAGE === 'fi') {
  defaultLanguage = fi;
}

export default function(state = defaultLanguage, action) {

  if(action.type === SET_LANGUAGE) {
    return action.language;
  }

  return state;
};
