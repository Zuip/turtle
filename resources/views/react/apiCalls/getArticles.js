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
    GlobalState.rootURL + '/api/articles' + query
  ).then(
    response => response.json()
  );
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
