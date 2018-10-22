import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(countryUrlName, language) { 
  return pipe(
    get,
    promiseJSON
  )(
    getUrl(countryUrlName, language)
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
