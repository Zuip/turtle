import { setLanguage } from '../store/actions';
import store from '../store/store';

import en from '../translations/en/en';
import fi from '../translations/fi/fi';

export default function(language) {

  let newLanguage = null;

  if(language === 'fi') {
    newLanguage = fi;
  }

  if(language === 'en') {
    newLanguage = en;
  }

  if(newLanguage !== null) {
    store.dispatch(setLanguage(newLanguage));
  }
}
