import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(language) {
  return pipe(
    get,
    promiseJSON
  )(
    '/api/countries?language=' + language
  );
};
