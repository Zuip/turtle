import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import Articles from '../Articles/Articles';
import getArticles from '../../apiCalls/getArticles';
import pageSpinner from '../../services/pageSpinner';

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

    pageSpinner.start('Frontpage articles');

    getArticles({
      language: this.props.translations.language,
      offset: this.state.articles.length,
      limit: this.state.articleBlockSize
    }).then(articles => {

      if(articles.length !== this.state.articleBlockSize) {
        this.setState({ allArticlesLoaded: true });
      }

      this.setState({
        articles: this.state.articles.concat(articles)
      });

      pageSpinner.finish('Frontpage articles');

    }).catch((error) => {
      console.error(error);
    });
  }

  componentDidMount() {
    this.loadNextArticles();
  }

  componentDidUpdate(previousProps) {

    if(previousProps.translations.language !== this.props.translations.language) {

      this.setState({
        articles: [],
        allArticlesLoaded: false
      }, () => {
        this.loadNextArticles();
      });
    }
  }

  render() {

    return (
      <ArticleLayout>
        <div className="frontpage">
          <h2>{this.props.translations.articles.latestArticles}</h2>
          <Articles articles={this.state.articles}
                    allArticlesLoaded={this.state.allArticlesLoaded}
                    loadNextArticles={this.loadNextArticles.bind(this)} />
        </div>
      </ArticleLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(FrontPage);
