import React from 'react';
import { connect } from 'react-redux';

import ArticleSummary from '../Article/ArticleSummary';
import getArticles from '../../apiCalls/getArticles';
import LoaderSpinner from '../LoaderSpinner';
import LoadMoreArticlesButton from './LoadMoreArticlesButton';

class FrontPage extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      articleBlockSize: 5,
      allArticlesLoaded: false
    };
  }

  loadNextArticles() {
    getArticles({
      language: this.props.translations.languageCode,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize
    }).then(articles => {

      if(articles.length !== this.state.articleBlockSize) {
        this.setState({ allArticlesLoaded: true });
      }

      this.setState({
        articles: this.state.articles.concat(articles)
      });

    }).catch((error) => {
      console.error(error);
    });
  }

  componentDidMount() {
    this.loadNextArticles();
  }

  componentDidUpdate(previousProps) {
    
    if(previousProps.translations.languageCode !== this.props.translations.languageCode) {

      this.setState({
        articles: [],
        allArticlesLoaded: false
      });

      this.loadNextArticles();
    }
  }

  render() {

    if(this.state.articles.length === 0) {
      return (
        <LoaderSpinner />
      );
    }

    return (
      <div className="frontpage">
        <h2>{this.props.translations.frontPage.latestArticles}</h2>
        {
          this.state.articles.map(function(article) {
            return (
              <ArticleSummary article={article} key={article.URLName} />
            );
          })
        }
        <LoadMoreArticlesButton allArticlesLoaded={this.state.allArticlesLoaded}
                                loadNextArticles={this.loadNextArticles.bind(this)} />
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(FrontPage);
