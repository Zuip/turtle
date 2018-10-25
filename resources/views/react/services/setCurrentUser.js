import { setUser } from '../store/actions';
import store from '../store/store';

export default function(user) {

  if(user === null) {
    store.dispatch(setUser(null));
    return;
  }

  if(user.id === null) {
    store.dispatch(setUser(null));
    return;
  }

  store.dispatch(setUser(user));
}
