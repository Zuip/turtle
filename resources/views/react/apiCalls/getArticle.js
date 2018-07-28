export default function(tripUrlName, countryUrlName, cityUrlName, language) {
  return fetch(
    '/api/trips/' + tripUrlName
    + '/' + countryUrlName
    + '/' + cityUrlName
    + '/article?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
