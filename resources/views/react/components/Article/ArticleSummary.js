import React from 'react';
import {render} from 'react-dom';
import {Link} from 'react-router-dom';

import {Language} from '../../services/Language.js';

class ArticleSummary extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <Link to={'/articles/' + this.props.article.URLName}>
        <div className="article article-summary">
          <h2>{this.props.article.boxTopic}</h2>
          <h3>{this.props.article.topic}</h3>
          <h5>{this.props.article.publishTime}</h5>
          <div dangerouslySetInnerHTML={{__html: this.props.article.summary}}></div>
          <p className="continue-reading">
            {Language.getTranslation("category.continueReading")}
            <i className="fa fa-chevron-right" aria-hidden="true"></i>
          </p>
        </div>
      </Link>
    );
  }
}

export {ArticleSummary};
