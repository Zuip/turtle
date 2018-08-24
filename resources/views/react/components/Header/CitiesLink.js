import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class CitiesLink extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <Link to={'/' + this.props.translations.routes.cities}>
        <div className="header-element header-link">
          <h3>{this.props.translations.cities.cities}</h3>
        </div>
      </Link>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CitiesLink);
