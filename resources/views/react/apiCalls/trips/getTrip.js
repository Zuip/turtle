export default function(tripUrlName, language) {
  return fetch(
    '/api/trips/' + tripUrlName
    + '?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
