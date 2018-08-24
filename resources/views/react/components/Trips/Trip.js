import React from 'react';
import { connect } from 'react-redux';

import BaseLayout from '../Layout/Grids/BaseLayout';
import TwoColumnLayout from '../Layout/Grids/TwoColumnLayout';
import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';

import Articles from '../Articles/Articles';
import getArticles from '../../apiCalls/getArticles';
import getTrip from '../../apiCalls/trips/getTrip';
import getTripTranslations from '../../apiCalls/trips/getTripTranslations';
import pageSpinner from '../../services/pageSpinner';

class Trip extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      articleBlockSize: 5,
      allArticlesLoaded: false,
      trip: {
        name: null
      }
    };
  }

  componentDidMount() {
    this.loadTrip();
    this.loadNextArticles();
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

  loadNextArticles() {

    pageSpinner.start('Trip articles');

    getArticles({
      language: this.props.translations.language,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize,
      tripUrlName: this.props.match.params.tripUrlName
    }).then(articles => {

      if(articles.length !== this.state.articleBlockSize) {
        this.setState({ allArticlesLoaded: true });
      }

      this.setState({
        articles: this.state.articles.concat(articles)
      });

      pageSpinner.finish('Trip articles');

    }).catch((error) => {
      console.error(error);
    });
  }

  render() {
    return (
      <BaseLayout>
        <TwoColumnLayout>
          <FirstColumn>
            <h1>{this.state.trip.name}</h1>
          </FirstColumn>
        </TwoColumnLayout>
        <TwoColumnLayout>
          <FirstColumn>
            <h3>{this.props.translations.articles.latestArticles}</h3>
            <Articles articles={this.state.articles}
                      allArticlesLoaded={this.state.allArticlesLoaded}
                      loadNextArticles={this.loadNextArticles.bind(this)} />
          </FirstColumn>
          <SecondColumn>
            
          </SecondColumn>
        </TwoColumnLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Trip);