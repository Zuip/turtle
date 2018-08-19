export default function(countryUrlName, cityUrlName, language) {
  return fetch(
    '/api/countries/' + countryUrlName
    + '/cities/' + cityUrlName
    + '?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
