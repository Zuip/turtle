import React from 'react';
import { connect } from 'react-redux';

import DropdownStyle from '../../../../style/elements/Dropdown';
import getCountries from '../../../../apiCalls/cities/getCountries';
import pageSpinner from '../../../../services/pageSpinner';
import logError from '../../../../services/logError';

class Country extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      countries: [],
      country: ''
    }
  }

  componentDidMount() {
    this.loadCountries();
  }

  componentDidUpdate(previousProps) {
    if(previousProps.translations.language !== this.props.translations.language) {
      this.loadCountries();
      this.setState({ country: '' });
    }
  }

  loadCountries() {

    pageSpinner.start('Countries');

    getCountries(
      this.props.translations.language
    ).then(
      countries => countries.sort(function(a, b) {

        if(a.name.toLowerCase() === b.name.toLowerCase()) {
          return 0;
        }

        return a.name.toLowerCase() > b.name.toLowerCase() ? 1 : -1;
      })
    ).then(countries => {
      this.setState({ countries });
      pageSpinner.finish('Countries');
    }).catch(
      error => logError(error, 'components/Cities/src/citySearchFields/Country.js')
    );
  }

  getOptions() {

    let options = this.state.countries.map(country => (
      <option value={country.urlName}
              key={'country_' + country.urlName}
              style={DropdownStyle.getOptionStyle()}>

        {country.name}

      </option>
    ));

    options.unshift(
      <option value="empty"
              key={'empty_country'}
              style={DropdownStyle.getOptionStyle()}>

        -

      </option>
    );

    options.unshift(
      <option value=""
              style={DropdownStyle.getHiddenOptionStyle()}
              key={'label_country'}>

        {this.props.translations.cities.countries.country}

      </option>
    );

    return options;
  }

  updateValue(event) {

    if(event.target.value === '' || event.target.value === 'empty') {
      this.setState({ country: '' });
      this.props.onChange(null);
      return;
    }

    this.setState({
      country: event.target.value
    });
    
    this.props.onChange(event.target.value);
  }

  getSelectStyle() {

    if(this.state.country === '') {
      return DropdownStyle.getSelectedEmptyValueStyle();
    }

    return null;
  }

  render() {
    return (
      <select value={this.state.country}
              className="form-control"
              style={this.getSelectStyle()}
              onChange={this.updateValue.bind(this)}>

        {this.getOptions()}

      </select>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Country);