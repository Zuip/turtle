import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(tripUrlName, countryUrlName, cityUrlName, cityVisitIndex, language) {
  return pipe(
    get,
    promiseJSON
  )(
    '/api/trips/' + tripUrlName
    + '/' + countryUrlName
    + '/' + cityUrlName
    + '/' + cityVisitIndex
    + '/article?language=' + language
  );
};
