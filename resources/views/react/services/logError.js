import postError from '../apiCalls/postError';

export default function(error, file) {
  console.log(error);
  postError(
    'React log error in ' + file + '\n'
    + String(error)
  );
};