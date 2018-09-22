import { setLanguage } from '../store/actions';
import store from '../store/store';

import putUserLanguage from '../apiCalls/putUserLanguage';

import en from '../translations/en/en';
import fi from '../translations/fi/fi';

import pageSpinner from './pageSpinner';

export default function(language) {

  let newLanguage = null;

  if(language === 'fi') {
    newLanguage = fi;
  }

  if(language === 'en') {
    newLanguage = en;
  }

  if(newLanguage === null) {
    return;
  }

  let state = store.getState();

  if(state.translations === newLanguage) {
    store.dispatch(setLanguage(newLanguage));
    return;
  }

  pageSpinner.start('Language');
  putUserLanguage(language).then(() => {
    store.dispatch(setLanguage(newLanguage));
    pageSpinner.finish('Language');
  });
}
