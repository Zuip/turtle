import React from 'react';
import { connect } from 'react-redux';

import TwoColumnLayout from '../Layout/Grids/TwoColumnLayout';
import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';

import Articles from '../Articles/Articles';
import getArticles from '../../apiCalls/getArticles';
import getTrip from '../../apiCalls/trips/getTrip';
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

      this.setState({
        articles: [],
        allArticlesLoaded: false
      }, () => {
        this.loadTrip();
        this.loadNextArticles();
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
      <div>
        <TwoColumnLayout>
          <FirstColumn>
            <h2>{this.state.trip.name}</h2>
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
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Trip);