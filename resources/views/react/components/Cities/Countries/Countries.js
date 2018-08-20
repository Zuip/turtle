import React from 'react';
import { connect } from 'react-redux';

import BaseLayout from '../../Layout/Grids/BaseLayout';
import TwoColumnLayout from '../../Layout/Grids/TwoColumnLayout';
import FirstColumn from '../../Layout/Grids/FirstColumn';
import SecondColumn from '../../Layout/Grids/SecondColumn';

import Articles from '../../Articles/Articles';
import getArticles from '../../../apiCalls/getArticles';
import getCountry from '../../../apiCalls/cities/getCountry';
import pageSpinner from '../../../services/pageSpinner';

class Country extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      articleBlockSize: 5,
      allArticlesLoaded: false,
      country: {
        name: null
      }
    };
  }

  componentDidMount() {
    this.loadCountry();
    this.loadNextArticles();
  }

  componentDidUpdate(previousProps) {

    if(previousProps.translations.language !== this.props.translations.language) {

      this.setState({
        articles: [],
        allArticlesLoaded: false
      }, () => {
        this.loadCountry();
        this.loadNextArticles();
      });
    }
  }

  loadCountry() {

    pageSpinner.start('Country');

    getCountry(
      this.props.match.params.countryUrlName,
      this.props.translations.language
    ).then(country => {
      this.setState({ country });
      pageSpinner.finish('Country');
    }).catch((error) => {
      console.error(error);
    });
  }

  loadNextArticles() {

    pageSpinner.start('Country articles');

    getArticles({
      language: this.props.translations.language,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize,
      countryUrlName: this.props.match.params.countryUrlName
    }).then(articles => {

      if(articles.length !== this.state.articleBlockSize) {
        this.setState({ allArticlesLoaded: true });
      }

      this.setState({
        articles: this.state.articles.concat(articles)
      });

      pageSpinner.finish('Country articles');

    }).catch((error) => {
      console.error(error);
    });
  }

  render() {
    return (
      <BaseLayout>
        <TwoColumnLayout>
          <FirstColumn>
            <h1>{this.state.country.name}</h1>
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
)(Country);