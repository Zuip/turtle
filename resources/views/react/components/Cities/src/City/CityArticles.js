import React from 'react';
import { connect } from 'react-redux';

import Articles from '../../../Articles/Articles';
import getArticles from '../../../../apiCalls/getArticles';
import pageSpinner from '../../../../services/pageSpinner';

class CityArticles extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      articleBlockSize: 5,
      allArticlesLoaded: false
    };
  }

  componentDidMount() {
    this.loadNextArticles();
  }

  loadNextArticles() {

    pageSpinner.start('City articles');

    getArticles({
      language: this.props.translations.language,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize,
      cityUrlName: this.props.city.urlName,
      countryUrlName: this.props.city.country.urlName
    }).then(articles => {

      if(articles.length !== this.state.articleBlockSize) {
        this.setState({ allArticlesLoaded: true });
      }

      this.setState({
        articles: this.state.articles.concat(articles)
      });

      pageSpinner.finish('City articles');

    }).catch((error) => {
      console.error(error);
    });
  }

  render() {
    return (
      <div>
        <h3>{this.props.translations.articles.latestArticles}</h3>
        <Articles articles={this.state.articles}
                  allArticlesLoaded={this.state.allArticlesLoaded}
                  loadNextArticles={this.loadNextArticles.bind(this)} />
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CityArticles);