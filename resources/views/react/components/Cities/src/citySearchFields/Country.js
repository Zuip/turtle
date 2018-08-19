import React from 'react';
import { connect } from 'react-redux';

class Country extends React.Component {
  render() {
    return (
      <select className="form-control">
        <option>{this.props.translations.cities.countries.country}</option>
      </select>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Country);