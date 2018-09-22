export default function(language) {
  return fetch(
    '/api/user/language',
    {
      method: 'PUT',
      headers: {
        'content-type': 'application/json',
        'X-CSRF-TOKEN': csrf_token
      },
      body: JSON.stringify({
        language
      }),
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};
