import store from '../store/store';

export default function(categoryURLName, page) {
  return fetch(
    '/api'
    + '/categories/' + categoryURLName
    + '/pages/' + page
    + '/' + store.translations.languageCode,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
