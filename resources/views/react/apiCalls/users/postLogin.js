import pipe from '../../services/pipe';
import post from '../../services/api/post';
import promiseJSON from '../../services/api/promiseJSON';

export default function(username, password) {
  return pipe(
    post({
      username,
      password
    }),
    promiseJSON
  )(
    '/api/login'
  );
};
