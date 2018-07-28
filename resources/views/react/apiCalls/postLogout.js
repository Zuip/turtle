export default function(username, password) {
  return Promise.all([
    fetch(
      '/api/logout',
      {
        method: 'POST',
        headers: {
          'content-type': 'application/json',
          'X-CSRF-TOKEN': csrf_token
        },
        credentials: 'same-origin'
      }
    ),
    fetch(
      '/admin/api/logout',
      {
        method: 'GET',
        headers: {
          'content-type': 'application/json'
        },
        credentials: 'same-origin'
      }
    )
  ]).then(
    response => response[0]
  );
};
