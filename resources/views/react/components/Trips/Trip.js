import React from 'react';
import { connect } from 'react-redux';

import BaseLayout from '../Layout/Grids/BaseLayout';
import TwoColumnLayout from '../Layout/Grids/TwoColumnLayout';
import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';

import TripArticles from './src/Trip/TripArticles';
import getTrip from '../../apiCalls/trips/getTrip';
import getTripTranslations from '../../apiCalls/trips/getTripTranslations';
import pageSpinner from '../../services/pageSpinner';
import VisitedCitiesMap from './src/Trip/VisitedCitiesMap';

class Trip extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      trip: null
    };
  }

  componentDidMount() {
    this.loadTrip();
  }

  componentDidUpdate(previousProps) {
    if(previousProps.translations.language !== this.props.translations.language) {
      this.loadTripTranslations(
        previousProps.translations.language
      ).then(tripTranslations => {

        let translationFound = false;

        tripTranslations.map(
          tripTranslation => {
            if(tripTranslation.language === this.props.translations.language) {
              
              this.props.history.push(
                '/' + this.props.translations.routes.trips
                + '/' + tripTranslation.urlName
              );
              
              translationFound = true;
            }
          }
        )

        if(!translationFound) {
          this.props.history.push(
            '/' + this.props.translations.routes.trips + '/404'
          );
        }
      });
    }
  }

  loadTrip() {

    pageSpinner.start('Trip');

    getTrip(
      this.props.match.params.tripUrlName,
      this.props.translations.language
    ).then(trip => {
      this.setState({ trip });
      pageSpinner.finish('Trip');
    }).catch((error) => {
      console.error(error);
    });
  }

  loadTripTranslations(language) {

    pageSpinner.start('Trip translations');

    return getTripTranslations(
      this.props.match.params.tripUrlName,
      language
    ).then(trip => {
      pageSpinner.finish('Trip translations');
      return trip;
    }).catch((error) => {
      console.error(error);
    });
  }

  render() {

    if(this.state.trip === null) {
      return null;
    }

    return (
      <BaseLayout>
        <TwoColumnLayout>
          <FirstColumn>
            <h1>{this.state.trip.name}</h1>
          </FirstColumn>
        </TwoColumnLayout>
        <TwoColumnLayout mobile={{ rightColumnIsOnTop: true }}>
          <FirstColumn>
            <TripArticles trip={this.state.trip} />
          </FirstColumn>
          <SecondColumn>
            <VisitedCitiesMap trip={this.state.trip} />
          </SecondColumn>
        </TwoColumnLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Trip);