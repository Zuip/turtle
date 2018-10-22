import put from '../../services/api/put';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(language) {
  return pipe(
    put({ language }),
    rejectHttpStatus400,
    promiseJSON
  )(
    '/api/user/language'
  );
};
