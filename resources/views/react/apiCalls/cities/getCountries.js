export default function(language) {
  return fetch(
    '/api/countries?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
