export default function(path) {
  return fetch(
    path,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  );
}