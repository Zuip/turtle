import get from '../../services/api/get';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(name) {
  return pipe(
    get,
    promiseJSON
  )(
    '/api/users?username=' + name
  );
};
