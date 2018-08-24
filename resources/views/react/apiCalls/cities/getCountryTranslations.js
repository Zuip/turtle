export default function(countryUrlName, language) {
  return fetch(
    '/api/countries/' + countryUrlName + '/translations'
    + '?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
