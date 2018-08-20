import ThemeSettings from '../ThemeSettings';

export default {
  getHiddenOptionStyle() {
    return {
      color: 'initial',
      display: 'none'
    };
  },
  getOptionStyle() {
    return {
      color: 'initial'
    };
  },
  getSelectedEmptyValueStyle() {
    return {
      color: ThemeSettings.themeGrey
    };
  }
};