export default function(userId, language) {
  return fetch(
    '/api/users/' + userId + '/trips?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
