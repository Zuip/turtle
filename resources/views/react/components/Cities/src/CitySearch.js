import React from 'react';
import { connect } from 'react-redux';

import CountryDropdown from './citySearchFields/Country';

class CitySearch extends React.Component {
  render() {
    return (
      <div>
        <h4>{this.props.translations.cities.citySearch}</h4>
        <CountryDropdown />
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CitySearch);