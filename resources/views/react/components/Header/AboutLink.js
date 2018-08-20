import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class AboutLink extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    if(CONFIG_ENVIRONMENT === 'production') {
      return null;
    }

    return (
      <Link to={'/about'}>
        <div id="header-about-link" className="header-element header-link">
          <h3>{this.props.translations.header.about}</h3>
        </div>
      </Link>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(AboutLink);
