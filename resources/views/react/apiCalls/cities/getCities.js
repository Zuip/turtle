export default function(countryUrlName, language) { 
  return fetch(
    getUrl(countryUrlName, language),
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
};

function getUrl(countryUrlName, language) {

  if(countryUrlName === null) {
    return '/api/cities?language=' + language;
  }

  return '/api'
       + '/countries/' + countryUrlName
       + '/cities'
       + '?language=' + language;
}
