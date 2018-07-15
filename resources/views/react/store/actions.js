export const FINISH_PAGE_LOADING = 'FINISH_PAGE_LOADING';
export const SET_LANGUAGE = 'SET_LANGUAGE';
export const SET_USER = 'SET_USER';
export const START_PAGE_LOADING = 'START_PAGE_LOADING';

export function finishPageLoading(itemToLoad) {
  return {
    type: FINISH_PAGE_LOADING,
    itemToLoad
  }
}

export function setLanguage(language) {
  return {
    type: SET_LANGUAGE,
    language
  }
}

export function setUser(user) {
  return {
    type: SET_USER,
    user
  }
}

export function startPageLoading(itemToLoad) {
  return {
    type: START_PAGE_LOADING,
    itemToLoad
  }
}
