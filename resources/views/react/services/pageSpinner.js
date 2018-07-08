import {
  finishPageLoading,
  startPageLoading
} from '../store/actions';

import store from '../store/store';

export default {
  start(contentToLoad) {
    store.dispatch(
      startPageLoading('Frontpage articles')
    );
  },
  finish(contentToLoad) {
    store.dispatch(
      finishPageLoading('Frontpage articles')
    );
  }
};
