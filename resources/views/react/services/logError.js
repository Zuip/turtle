import postError from '../apiCalls/postError';

export default function(error, file) {
  postError(
    'React log error in ' + file + '\n'
    + JSON.stringify(error)
  );
};