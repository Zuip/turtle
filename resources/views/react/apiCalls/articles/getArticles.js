import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(params) {

  let query = [
    getLanguageQuery(params),
    getLimitQuery(params),
    getOffsetQuery(params)
  ].join('&');

  if(query.length > 0) {
    query = '?' + query;
  }

  return pipe(
    get,
    promiseJSON
  )(
    getUrlBase(params) + query
  );
}

function getUrlBase(params) {

  if(typeof params.userId !== 'undefined') {
    return '/oldapi/users/' + params.userId + '/articles';
  }

  if(typeof params.countryUrlName !== 'undefined') {

    let countryBase = '/oldapi/countries/' + params.countryUrlName;

    if(typeof params.cityUrlName !== 'undefined') {
      return countryBase + '/cities/' + params.cityUrlName + '/articles';
    }

    return countryBase + '/articles';
  }

  if(typeof params.tripUrlName !== 'undefined') {
    return '/oldapi/trips/' + params.tripUrlName + '/articles';
  }

  return '/oldapi/articles'
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
