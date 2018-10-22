import React from 'react';
import { connect } from 'react-redux';

import Articles from '../../Articles/Articles';
import getArticles from '../../../apiCalls/articles/getArticles';
import pageSpinner from '../../../services/pageSpinner';

class UserArticles extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      articleBlockSize: 5,
      allArticlesLoaded: false
    };
  }

  loadNextArticles() {

    pageSpinner.start('User articles');

    getArticles({
      language: this.props.translations.language,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize,
      userId: this.props.user.id
    }).then(articles => {

      if(articles.length !== this.state.articleBlockSize) {
        this.setState({ allArticlesLoaded: true });
      }

      this.setState({
        articles: this.state.articles.concat(articles)
      });

      pageSpinner.finish('User articles');

    }).catch((error) => {
      console.error(error);
    });
  }

  componentDidMount() {
    this.loadNextArticles();
  }

  render() {

    if(this.state.articles.length === 0) {
      return null;
    }

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
)(UserArticles);
