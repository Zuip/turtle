import { FINISH_PAGE_LOADING, START_PAGE_LOADING } from '../../actions';

export default function(state = [], action) {

  if(action.type === START_PAGE_LOADING) {
    let newState = state.slice();
    newState.push(action.itemToLoad);
    return newState;
  }

  if(action.type === FINISH_PAGE_LOADING) {

    let newState = state.slice();
    let index = newState.indexOf(action.itemToLoad);

    if(index > -1) {
      newState.splice(index, 1);
    }

    return newState;
  }

  return state;
};
