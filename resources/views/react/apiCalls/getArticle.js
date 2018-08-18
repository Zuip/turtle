export default function(tripUrlName, countryUrlName, cityUrlName, cityVisitIndex, language) {
  return fetch(
    '/api/trips/' + tripUrlName
    + '/' + countryUrlName
    + '/' + cityUrlName
    + '/' + cityVisitIndex
    + '/article?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
