import ThemeSettings from '../../ThemeSettings';

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
      padding: '1.2rem'
    }
  },
  h4: {
    margin: '1rem 0'
  },
  search: {
    h4: {
      margin: '0',
      padding: '1rem 0'
    }
  }
};