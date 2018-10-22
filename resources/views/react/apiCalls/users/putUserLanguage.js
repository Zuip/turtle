import pipe from '../../services/pipe';
import put from '../../services/api/put';
import promiseJSON from '../../services/api/promiseJSON';

export default function(language) {
  return pipe(
    put({ language }),
    promiseJSON
  )(
    '/api/user/language'
  );
};
