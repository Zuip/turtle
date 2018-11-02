import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(tripUrlName, language) {
  return pipe(
    get,
    promiseJSON
  )(
    '/api/trips/' + tripUrlName
    + '?language=' + language,
    {
      method: 'GET',
      credentials: 'same-origin'
    }
  );
};
