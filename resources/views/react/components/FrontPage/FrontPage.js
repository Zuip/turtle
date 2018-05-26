import React from 'react';
import {render} from 'react-dom';

import {Language} from '../../services/Language.js';
import {LoaderSpinner} from '../LoaderSpinner.js';

import {ArticleSummary} from '../Article/ArticleSummary.js';

class FrontPage extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      frontPageArticles: []
    };
  }

  loadFrontPageArticles() {
    fetch(GlobalState.rootURL + '/api/frontpage/articles/' + GlobalState.language)
    .then((response) => response.json())
    .then((response) => {
      this.setState({
        frontPageArticles: response.articles
      });
    })
    .catch((error) => {
      console.error(error);
    });
  }

  componentDidMount() {
    Language.init(this);
    this.loadFrontPageArticles();
  }

  render() {

    if(!Language.initialized || this.state.frontPageArticles.length === 0) {
      return (
        <LoaderSpinner />
      );
    }

    return (
      <div>
        <p>{Language.getTranslation("frontPage.introduction")}</p>
        {
          this.state.frontPageArticles.map(function(frontPageArticle) {
            return (
              <ArticleSummary article={frontPageArticle} key={frontPageArticle.type} />
            );
          })
        }
      </div>
    );
  }
}

export {FrontPage};
