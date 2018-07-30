import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import ArticlePath from './ArticlePath.js';
import ArticlePageChanger from './ArticlePageChanger.js';
import getArticle from '../../apiCalls/getArticle';
import pageSpinner from '../../services/pageSpinner';

class Article extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      article: null
    }
  }

  componentDidMount() {
    this.loadArticle();
  }

  componentWillReceiveProps(newProps) {
    if(newProps.match.params.articleURLName !== this.props.match.params.articleURLName) {
      this.props = newProps;
      this.setState({
        article: null
      });
      this.forceUpdate();
      this.loadArticle();
    }
  }

  loadArticle() {

    pageSpinner.start('article');

    getArticle(
      this.props.match.params.tripURLName,
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      this.props.translations.languageCode
    ).then(response => {

      this.setState({
        article: response
      });

      pageSpinner.finish('article');

    }).catch(
      error => console.error(error)
    );
  }

  render() {

    if(this.state.article === null) {
      return null;
    }

    return (
      <ArticleLayout>
        <div className="article">
          <h3>{this.state.article.city.name}, {this.state.article.city.country.name}</h3>
          <h5>{this.state.article.publishTime}, <ArticlePath article={this.state.article} /></h5>
          <div className="summary" dangerouslySetInnerHTML={{__html: this.state.article.summary}}></div>
          <div dangerouslySetInnerHTML={{__html: this.state.article.text}}></div>
          <ArticlePageChanger previousArticle={this.state.article.previousArticle} nextArticle={this.state.article.nextArticle} />
        </div>
      </ArticleLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Article);
