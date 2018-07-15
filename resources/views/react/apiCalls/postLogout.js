export default function(username, password) {
  return fetch(
    '/api/logout',
    {
      method: 'POST',
      headers: {
        'content-type': 'application/json',
        'X-CSRF-TOKEN': csrf_token
      },
      credentials: 'same-origin'
    }
  );
};
