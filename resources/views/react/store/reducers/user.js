import {SET_USER} from '../actions';

export default function(state = null, action) {

  if(action.type === SET_USER) {

    if(isZeroLengthObject(action.user)) {
      return null;
    }

    return action.user;
  }

  return state;
};

function isZeroLengthObject(variable) {

  if(variable === null) {
    return false;
  }

  if(typeof variable !== 'object') {
    return false;
  }

  return Object.getOwnPropertyNames(variable).length === 0;
}
