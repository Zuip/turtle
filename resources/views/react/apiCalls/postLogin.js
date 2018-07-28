export default function(username, password) {
  return Promise.all([
    fetch(
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
    ),
    fetch(
      '/admin/api/login',
      {
        method: 'POST',
        headers: {
          'content-type': 'application/json'
        },
        body: JSON.stringify({
          username,
          password
        }),
        credentials: 'same-origin'
      }
    )
  ]).then(
    response => response[0].json()
  );
};
