import React from 'react';
import {render} from 'react-dom';

import {Language} from '../../services/Language.js';
import {LoaderSpinner} from '../LoaderSpinner.js';
import {ArticlePath} from './ArticlePath.js';
import {ArticlePageChanger} from './ArticlePageChanger.js';

class Article extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      article: null
    }
  }

  componentDidMount() {
    Language.init(this);
    this.loadArticle();
  }

  componentWillReceiveProps(newProps) {
    if(newProps.match.params.articleURLName !== this.props.match.params.articleURLName) {
      this.props = newProps;
      this.state.article = null;
      this.forceUpdate();
      this.loadArticle();
    }
  }

  loadArticle() {
    fetch(
      GlobalState.rootURL + '/api/articles'
      + '/' + this.props.match.params.articleURLName
      + '/' + GlobalState.language
    )
    .then((response) => response.json())
    .then((response) => {
      this.setState({
        article: response
      });
    })
    .catch((error) => {
      console.error(error);
    });
  }

  render() {

    if(!Language.initialized || this.state.article === null) {
      return (
        <LoaderSpinner />
      );
    }

    return (
      <div className="article">
        <h3>{this.state.article.topic}</h3>
        <h5>{this.state.article.publishTime}, <ArticlePath pathArray={this.state.article.path} /></h5>
        <p dangerouslySetInnerHTML={{__html: this.state.article.text}}></p>
        <ArticlePageChanger previousArticle={this.state.article.previousArticle} nextArticle={this.state.article.nextArticle} />
      </div>
    );
  }
}

export {Article};
