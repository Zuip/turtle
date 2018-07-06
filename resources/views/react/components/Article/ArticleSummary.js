import React from 'react';
import { Link } from 'react-router-dom';
import store from '../../store/store';

class ArticleSummary extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <Link to={'/articles/' + this.props.article.URLName}>
        <div className="article article-summary">
          <h3>{this.props.article.topic}</h3>
          <h5>{this.props.article.publishTime}</h5>
          <div dangerouslySetInnerHTML={{__html: this.props.article.summary}}></div>
          <p className="continue-reading">
            {store.getState().translations.article.continueReading}
            <i className="fa fa-chevron-right" aria-hidden="true"></i>
          </p>
        </div>
      </Link>
    );
  }
}

export default ArticleSummary;
