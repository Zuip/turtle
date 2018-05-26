let Language = {

  translations: {},
  code: 'fi',
  URLBase: '',
  initialized: false,

  init: function(component) {

    if(this.initialized) {
      return;
    }

    this.code = $(document.querySelector('html')).attr('lang');

    if ($(document.querySelector('html')).attr('lang') === 'fi') {
      this.URLBase = '';
    } else {
      this.URLBase = '/' + $(document.querySelector('html')).attr('lang');
    }

    this.updateTranslations(component);
  },

  updateTranslations: function(component) {
    let language = this;
    $.get('/api/' + this.code + '/translations')
     .done(function(data) {
       language.translations = data;
       language.initialized = true;
       component.forceUpdate();
     });
  },

  getTranslation(translationPath) {

    if(!this.initialized) {
      return false;
    }

    let translation = this.translations;
    let translationPathArray = translationPath.split(".");

    while(translationPathArray.length > 0) {
      translation = translation[translationPathArray.shift()];
    }

    return translation;
  }
};

export {Language};
