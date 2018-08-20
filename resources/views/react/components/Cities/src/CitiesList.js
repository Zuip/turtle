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

  componentDidUpdate(newProps) {
    if(newProps.filter !== this.props.filter) {
      this.loadCities()
    }
  }

  getCityBoxes() {
    return this.state.cities.map(
      city => (
        <CityBox city={city}
                 key={'city_' + city.country.urlName + '_' + city.urlName} />
      )
    );
  }

  loadCities() {

    pageSpinner.start('Cities');

    getCities(
      this.props.filter.country,
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