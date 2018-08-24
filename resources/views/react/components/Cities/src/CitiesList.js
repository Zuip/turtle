import React from 'react';
import { connect } from 'react-redux';

import CityBox from './CityBox';
import getCities from '../../../apiCalls/cities/getCities';
import pageSpinner from '../../../services/pageSpinner';

class CitiesList extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      cities: []
    }
  }

  componentDidMount() {
    this.loadCities();
  }

  componentDidUpdate(previousProps) {
    if(previousProps.filter !== this.props.filter) {
      this.loadCities()
    }
  }

  getCityBoxes() {
    return this.state.cities.sort(
      (a, b) => a.name.toLowerCase() > b.name.toLowerCase()
    ).map(
      city => (
        <CityBox city={city}
                 key={'city_' + city.country.urlName + '_' + city.urlName} />
      )
    );
  }

  loadCities(withoutFilter) {

    pageSpinner.start('Cities');

    let filter = this.props.filter;
    if(withoutFilter) {
      filter = {
        country: null
      }
    }

    getCities(
      filter.country,
      this.props.translations.language
    ).then(cities => {
      this.setState({ cities });
      pageSpinner.finish('Cities');
    }).catch(error => {
      console.log(error);
    });
  }

  render() {
    return (
      <div>
        {this.getCityBoxes()}
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CitiesList);