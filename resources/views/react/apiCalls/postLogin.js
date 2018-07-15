export default function(username, password) {
  return fetch(
    '/api/login',
    {
      method: 'POST',
      headers: {
        'content-type': 'application/json',
        'X-CSRF-TOKEN': csrf_token
      },
      body: JSON.stringify({
        username,
        password
      }),
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
