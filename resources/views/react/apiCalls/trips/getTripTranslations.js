import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(tripUrlName, language) {
  return pipe(
    get,
    promiseJSON
  )(
    '/oldapi/trips/' + tripUrlName + '/translations'
    + '?language=' + language
  );
};
  