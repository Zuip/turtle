import { fetch as fetchPolyfill } from 'whatwg-fetch';

export default function(path) {
  return fetchPolyfill(
    path,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  );
}