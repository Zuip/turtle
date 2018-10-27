import {SET_USER} from '../actions';

export default function(state = null, action) {

  if(action.type === SET_USER) {
    return action.user;
  }

  return state;
};
