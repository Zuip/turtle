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