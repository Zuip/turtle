import React from 'react';
import { connect } from 'react-redux';

import CountryDropdown from './citySearchFields/Country';

class CitySearch extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      country: null
    }
  }

  countryDropdownChanged(country) {
    this.setState(
      { country },
      () => this.filterUpdated()
    );
  }

  filterUpdated() {
    this.props.filterUpdated({
      country: this.state.country
    });
  }

  render() {
    return (
      <div>
        <h4>{this.props.translations.cities.citySearch}</h4>
        <CountryDropdown onChange={this.countryDropdownChanged.bind(this)} />
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CitySearch);