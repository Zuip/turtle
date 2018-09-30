
import ThemeSettings from '../../ThemeSettings';

let i = {
  position: 'relative',
  top: '1px'
};

let pageChanger = {
  margin: '2em 0',
  iLeft: {
    ...i,
    marginRight: '1rem'
  },
  iRight: {
    ...i,
    marginLeft: '1rem'
  },
  next: {
    float: 'right',
    marginRight: '1.2rem'
  },
  previous: {
    float: 'left',
    marginLeft: '1.2rem'
  }
};

export default {
  h2: {
    marginBottom: '0'
  },
  pageChanger,
  path: {
    h6: {
      color: ThemeSettings.themeGrey,
      marginLeft: '1.5rem',
      marginTop: '0'
    }
  }
};
