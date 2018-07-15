export default function(articleURLName) {
  return fetch(
    '/api/articles/' + articleURLName,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
