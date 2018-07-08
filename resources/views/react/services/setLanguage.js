import { setLanguage } from '../store/actions';
import store from '../store/store';

import en from '../translations/en/en';
import fi from '../translations/fi/fi';

export default function(languageCode) {

  let newLanguage = null;

  if(languageCode === 'fi') {
    newLanguage = fi;
  }

  if(languageCode === 'en') {
    newLanguage = en;
  }

  if(newLanguage !== null) {
    store.dispatch(setLanguage(newLanguage));
  }
}
