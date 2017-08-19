import React from 'react';
import {render} from 'react-dom';

import {Language} from '../../services/Language.js';
import {LoaderSpinner} from '../LoaderSpinner.js';

import {ArticleSummary} from '../Article/FrontPageArticle.js';

class Category extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      category: null
    }
  }

  componentDidMount() {
    Language.init(this);
    this.loadCategory();
  }

  componentWillReceiveProps(newProps) {
    if(newProps.match.params.articleURLName !== this.props.match.params.articleURLName) {
      this.props = newProps;
      this.setState({
        category: null
      });
      this.loadCategory();
    }
  }

  loadCategory() {
    fetch(
      GlobalState.rootURL + '/api'
      + '/categories/' + this.props.match.params.categoryURLName
      + '/pages/' + this.props.match.params.page
      + '/' + GlobalState.language
    )
    .then((response) => response.json())
    .then((response) => {
      this.setState({
        category: response
      });
    })
    .catch((error) => {
      console.error(error);
    });
  }

  render() {

    if(!Language.initialized || this.state.category === null) {
      return (
        <LoaderSpinner />
      );
    }

    return (
      <div>
        <h2>{this.state.category.name}</h2>
        <p>{this.state.category.description}</p>
        {
          this.state.category.articles.map(function(article) {
            return (
              <ArticleSummary article={article} key={article.id} />
            );
          })
        }
      </div>
    );
  }
}

export {Category};
