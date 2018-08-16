export default function(params) {

  let query = [
    getLanguageQuery(params),
    getLimitQuery(params),
    getOffsetQuery(params)
  ].join('&');

  if(query.length > 0) {
    query = '?' + query;
  }

  return fetch(
    getUrlBase(params) + query,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  ).then(
    response => response.json()
  );
}

function getUrlBase(params) {

  if(typeof params.userId !== 'undefined') {
    return '/api/users/' + params.userId + '/articles';
  }

  return '/api/articles'
}

function getLanguageQuery(params) {

  if(typeof params.language === 'undefined') {
    return '';
  }

  return 'language=' + params.language;
}

function getLimitQuery(params) {

  if(typeof params.limit === 'undefined') {
    return '';
  }

  return 'limit=' + params.limit;
}

function getOffsetQuery(params) {

  if(typeof params.offset === 'undefined') {
    return '';
  }

  return 'offset=' + params.offset;
}
