import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import Articles from '../Articles/Articles';
import getArticles from '../../apiCalls/getArticles';
import getCity from '../../apiCalls/cities/getCity';
import pageSpinner from '../../services/pageSpinner';

class City extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      articleBlockSize: 5,
      allArticlesLoaded: false,
      city: {
        name: null,
        country: {
          name: null
        }
      }
    };
  }

  componentDidMount() {
    this.loadCity();
    this.loadNextArticles();
  }

  componentDidUpdate(previousProps) {

    if(previousProps.translations.language !== this.props.translations.language) {

      this.setState({
        articles: [],
        allArticlesLoaded: false
      }, () => {
        this.loadCity();
        this.loadNextArticles();
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

  loadNextArticles() {

    pageSpinner.start('City articles');

    getArticles({
      language: this.props.translations.language,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize,
      cityUrlName: this.props.match.params.cityUrlName,
      countryUrlName: this.props.match.params.countryUrlName
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

  getCountryPath() {
    return '/countries/' + this.state.city.country.urlName;
  }

  render() {
    return (
      <ArticleLayout>
        <h2>
          <Link to={this.getCountryPath()}>{this.state.city.name}</Link>, {this.state.city.country.name}
        </h2>
        <h3>{this.props.translations.articles.latestArticles}</h3>
        <Articles articles={this.state.articles}
                  allArticlesLoaded={this.state.allArticlesLoaded}
                  loadNextArticles={this.loadNextArticles.bind(this)} />
      </ArticleLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(City);