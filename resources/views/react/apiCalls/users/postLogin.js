import post from '../../services/api/post';
import promiseJSON from '../../services/api/promiseJSON';
import pipe from '../../services/pipe';

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
