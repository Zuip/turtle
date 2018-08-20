import React from 'react';
import { connect } from 'react-redux';

import ArticleSummary from './ArticleSummary';
import LoadMoreArticlesButton from './LoadMoreArticlesButton';

class Articles extends React.Component {

  constructor(props) {
    super(props);
  }

  getArticleSummaries() {
    return this.props.articles.map((article, index) => {
      return (
        <ArticleSummary article={article} key={'article_' + index} />
      );
    })
  }

  render() {

    if(this.props.articles.length === 0) {
      return (
        <div>
          <p>{this.props.translations.articles.noArticlesExists}</p>
        </div>
      );
    }

    return (
      <div>
        {this.getArticleSummaries()}
        <LoadMoreArticlesButton allArticlesLoaded={this.props.allArticlesLoaded}
                                loadNextArticles={this.props.loadNextArticles} />
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Articles);