export default function(userId, languageCode) {
  return fetch(
    '/api/users/' + userId + '/trips?language=' + languageCode,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
