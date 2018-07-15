export default function() {
  return fetch(
    '/api/user',
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  ).then(response => {
    
    if(response === []) {
      return null;
    }

    return response;
  });
};
