import React from 'react';
import { connect } from 'react-redux';

import setLanguage from '../../services/setLanguage';

class MobileLanguageSelect extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      availableLanguages: [
        'fi',
        'en'
      ]
    }
  }

  isActiveLanguage(availableLanguage) {
    return availableLanguage === this.props.selectedLanguage;
  }

  render() {
    return (
      <div className="mobile-language-select">
        <div className="btn-group" role="group">
          {
            this.state.availableLanguages.map(availableLanguage => {
              return (

                <button type="button"
                        className={"btn"}
                        disabled={this.isActiveLanguage(availableLanguage)}
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
  state => ({ selectedLanguage: state.translations.language })
)(MobileLanguageSelect);
