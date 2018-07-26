export default function(name) {
  return fetch(
    '/api/users?username=' + name,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(response => {

    if(response.status === 404) {
      return Promise.reject({
        status: 404
      });
    }

    return response;

  }).then(
    response => response.json()
  );
};
