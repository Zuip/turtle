export default function(tripUrlName, countryUrlName, cityUrlName, cityVisitIndex, language) {
  return fetch(
    '/api/trips/' + tripUrlName
    + '/' + countryUrlName
    + '/' + cityUrlName
    + '/' + cityVisitIndex
    + '/article'
    + '/translations'
    + '?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
