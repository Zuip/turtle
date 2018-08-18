export default function(tripUrlName, countryUrlName, cityUrlName, cityVisitIndex, language) {
  return fetch(
    '/api/trips/' + tripUrlName
    + '/' + countryUrlName
    + '/' + cityUrlName
    + '/' + cityVisitIndex
    + '/article'
    + '/previous?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => {

      if(response.status === 404) {
        return Promise.reject();
      }

      return response;
    }
  ).then(
    response => response.json()
  );
};
