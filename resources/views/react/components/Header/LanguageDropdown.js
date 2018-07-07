import React from 'react';

class LanguageDropdown extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      selectedLanguage: 'FI',
      availableLanguages: [
        'FI',
        'EN'
      ]
    }
  }

  render() {
    return (
      <div className="dropdown header-right">
        <button className="dropdown-toggle" id="language-dropdown-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {this.state.selectedLanguage}
        </button>
        <div className="dropdown-menu" aria-labelledby="language-dropdown-menu">
          {
            this.state.availableLanguages.map(availableLanguage => {
              return (
                <button className="dropdown-item" type="button">
                  {availableLanguage}
                </button>
              );
            })
          }
        </div>
      </div>
    );
  }
}

export default LanguageDropdown;
