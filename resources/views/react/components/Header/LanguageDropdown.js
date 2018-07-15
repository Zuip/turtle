import React from 'react';
import { connect } from 'react-redux';

import setLanguage from '../../services/setLanguage';

class LanguageDropdown extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      availableLanguages: [
        'fi',
        'en'
      ]
    }
  }

  render() {
    return (
      <div className="dropdown header-right">
        <button className="dropdown-toggle" id="language-dropdown-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span className="dropdown-toggle-text text-uppercase">
            {this.props.selectedLanguage}
          </span>
        </button>
        <div className="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown-menu">
          {
            this.state.availableLanguages.map(availableLanguage => {
              return (

                <button className="dropdown-item text-uppercase"
                        type="button"
                        key={availableLanguage}
                        onClick={() => setLanguage(availableLanguage)}>

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

export default connect(
  state => ({ selectedLanguage: state.translations.languageCode })
)(LanguageDropdown);
