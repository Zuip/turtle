import React from 'react';

import ArticleSummary from '../Article/ArticleSummary.js';
import Language from '../../services/Language.js';
import LoaderSpinner from '../LoaderSpinner.js';
import Pagination from './Pagination/Pagination.js';

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

  componentWillReceiveProps(props) {

    let pageChanged = function(oldProps, newProps) {

      if(newProps.categoryURLName !== oldProps.categoryURLName) {
        return true;
      }

      if(newProps.match.params.page !== oldProps.match.params.page) {
        return true;
      }

      return false;
    }

    if(pageChanged(this.props, props)) {
      this.props = props;
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
      <div className="category">
        <h2>{this.state.category.name}</h2>
        <p>{this.state.category.description}</p>

        <Pagination categoryURLName={this.props.match.params.categoryURLName}
                    amountOfArticles={this.state.category.amountOfArticles}
                    currentPage={this.props.match.params.page} />

        {
          this.state.category.articles.map(function(article) {
            return (
              <ArticleSummary article={article} key={article.id} />
            );
          })
        }

        <Pagination categoryURLName={this.props.match.params.categoryURLName}
                    amountOfArticles={this.state.category.amountOfArticles}
                    currentPage={this.props.match.params.page} />
      </div>
    );
  }
}

export default Category;
