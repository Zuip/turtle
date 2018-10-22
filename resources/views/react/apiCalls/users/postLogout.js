import post from '../../services/api/post';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

export default function(data) {
  return pipe(
    post(data),
    rejectHttpStatus400,
    promiseJSON
  )(
    '/api/logout'
  );
};
