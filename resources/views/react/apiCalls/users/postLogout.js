import pipe from '../../services/pipe';
import post from '../../services/api/post';
import promiseJSON from '../../services/api/promiseJSON';

export default function(data) {
  return pipe(
    post(data),
    promiseJSON
  )(
    '/oldapi/logout'
  );
};
