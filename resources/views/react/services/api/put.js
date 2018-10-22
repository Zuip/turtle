import { fetch as fetchPolyfill } from 'whatwg-fetch';

export default function(data) {
  return function(path) {
    return fetchPolyfill(
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
