import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';
import TwoColumnLayout from '../Layout/Grids/TwoColumnLayout';

import BaseLayout from '../Layout/Grids/BaseLayout';
import CityArticles from './src/City/CityArticles';
import CityUsers from './src/City/CityUsers';
import getCity from '../../apiCalls/cities/getCity';
import getCityTranslations from '../../apiCalls/cities/getCityTranslations';
import getCountryPath from '../../services/paths/getCountryPath';
import pageSpinner from '../../services/pageSpinner';

class City extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      city: null
    };
  }

  componentDidMount() {
    this.loadCity();
  }

  componentDidUpdate(previousProps) {
    if(previousProps.translations.language !== this.props.translations.language) {
      this.loadCityTranslations(
        previousProps.translations.language
      ).then(cityTranslations => {
        cityTranslations.map(
          cityTranslation => {
            if(cityTranslation.language === this.props.translations.language) {
              this.props.history.push(
                '/' + this.props.translations.routes.countries
                + '/' + cityTranslation.country.urlName
                + '/' + this.props.translations.routes.cities
                + '/' + cityTranslation.urlName
              );
            }
          }
        )
      });
    }
  }

  loadCity() {

    pageSpinner.start('City');

    getCity(
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      this.props.translations.language
    ).then(city => {
      this.setState({ city });
      pageSpinner.finish('City');
    }).catch((error) => {
      console.error(error);
    });
  }

  getTopic() {

    let countryPath = getCountryPath(
      this.state.city.country,
      this.props.translations
    );

    let city = this.state.city.name;
    
    let country = (
      <Link to={countryPath}>
        {this.state.city.country.name}
      </Link>
    );

    return (
      <h1>
        {city}, {country}
      </h1>
    );
  }

  loadCityTranslations(language) {

    pageSpinner.start('City translations');

    return getCityTranslations(
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      language
    ).then(city => {
      pageSpinner.finish('City translations');
      return city;
    }).catch((error) => {
      console.error(error);
    });
  }

  render() {

    if(this.state.city === null) {
      return null;
    }

    return (
      <BaseLayout>
        <TwoColumnLayout>
          <FirstColumn>
            {this.getTopic()}
          </FirstColumn>
        </TwoColumnLayout>
        <TwoColumnLayout>
          <FirstColumn>
            <CityArticles city={this.state.city} />
          </FirstColumn>
          <SecondColumn>
            <CityUsers city={this.state.city} />
          </SecondColumn>
        </TwoColumnLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(City);