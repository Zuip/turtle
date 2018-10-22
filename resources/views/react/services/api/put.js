export default function(data) {
  return function(path) {
    return fetch(
      path,
      {
        method: 'PUT',
        headers: {
          'content-type': 'application/json',
          'X-CSRF-TOKEN': csrf_token
        },
        body: JSON.stringify(data),
        credentials: 'same-origin'
      }
    );
  };
};
