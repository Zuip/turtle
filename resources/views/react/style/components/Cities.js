import ThemeSettings from '../ThemeSettings';

export default {
  getContentColumnStyle() {
    return {
      padding: '10px 0'
    }
  },
  getLeftBarStyle() {
    return {
      backgroundColor: ThemeSettings.themeHoverColor,
      color: '#FFFFFF',
      height: '100%',
      padding: '0 15px',
      width: '100%'
    };
  },
  getBoxStyle() {
    return {
      backgroundColor: ThemeSettings.themeLightGrey,
      border: '1px solid ' + ThemeSettings.themeGrey,
      display: 'block',
      margin: '10px 0',
      minHeight: '100px',
      padding: '15px'
    }
  }
};