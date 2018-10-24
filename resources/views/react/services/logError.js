import postError from '../apiCalls/postError';

export default function(error) {
  postError(
    "React log error\n"
    + JSON.stringify(error)
  );
};