import { setUser } from '../store/actions';
import store from '../store/store';

export default function(user) {
  store.dispatch(setUser(user));
}
