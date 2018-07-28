import ThemeSettings from '../ThemeSettings';

export default {
  borderBottom: '1px solid ' + ThemeSettings.themeSemiDarkGrey,
  width: '100%',
  header: {
    row: {
      backgroundColor: ThemeSettings.themeColor,
      border: '1px solid ' + ThemeSettings.themeColor,
      color: ThemeSettings.textColorOnThemeColor,
      cell: {
        h4: {
          margin: '10px'
        }
      }
    }
  },
  row: {
    borderLeft: '1px solid ' + ThemeSettings.themeSemiDarkGrey,
    borderRight: '1px solid ' + ThemeSettings.themeSemiDarkGrey,
    cell: {
      p(position) {

        if(position === 'first') {
          return {
            margin: '18px 10px 10px 10px'
          };
        }

        if(position === 'last') {
          return {
            margin: '10px 10px 18px 10px'
          };
        }

        return {
          margin: '10px'
        };
      }
    }
  }
};