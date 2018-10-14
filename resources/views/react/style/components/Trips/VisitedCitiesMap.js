import ThemeSettings from '../../ThemeSettings';

export default {
  height: '600px',
  margin: '20px 0',
  maxHeight: '90vh',
  pointer: {
    backgroundColor: ThemeSettings.themeColor,
    border: '2px solid ' + ThemeSettings.textColorOnThemeColor,
    borderRadius: '50%',
    cursor: 'pointer',
    height: '16px',
    transform: 'translate(-50%, -50%)',
    width: '16px'
  },
  tooltip: {
    element: {
      backgroundColor: 'white',
      color: ThemeSettings.themeColor
    },
    transform: 'translate(-50%, -50%)'
  },
  width: '100%',
};