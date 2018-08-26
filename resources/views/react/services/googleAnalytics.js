import ReactGA from 'react-ga';
import createHistory from 'history/createBrowserHistory'

if(CONFIG_GOOGLE_ANALYTICS_KEY !== '') {
  ReactGA.initialize(CONFIG_GOOGLE_ANALYTICS_KEY);
}

let history = createHistory();
history.listen((location) => {
  if(CONFIG_GOOGLE_ANALYTICS_KEY !== '') {
    ReactGA.set({ page: location.pathname });
    ReactGA.pageview(location.pathname);
  }
});

export default history;