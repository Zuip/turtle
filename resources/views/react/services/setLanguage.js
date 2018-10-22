import { setLanguage } from '../store/actions';
import store from '../store/store';

import putUserLanguage from '../apiCalls/users/putUserLanguage';

import en from '../translations/en/en';
import fi from '../translations/fi/fi';

import pageSpinner from './pageSpinner';

export default function(languageCode) {

  return Promise.resolve().then(() => {

    let language = getNewLanguage(languageCode);
    if(language === null) {
      return;
    }

    let state = store.getState();

    if(state.translations === language) {
      return;
    }

    pageSpinner.start('Language');
    return putUserLanguage(languageCode).then(() => {
      store.dispatch(setLanguage(language));
      pageSpinner.finish('Language');
    });
  });
}

function getNewLanguage(languageCode) {

  if(languageCode === 'fi') {
    return fi;
  }

  if(languageCode === 'en') {
    return en;
  }

  return null;
}
