import ThemeSettings from '../../ThemeSettings';

export default {
  height: '600px',
  maxHeight: '90vh',
  pointer: {
    backgroundColor: ThemeSettings.themeColor,
    border: '2px solid ' + ThemeSettings.textColorOnThemeColor,
    borderRadius: '50%',
    height: '16px',
    transform: 'translate(-50%, -50%)',
    width: '16px'
  },
  width: '100%',
};