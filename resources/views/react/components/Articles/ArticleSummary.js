import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import store from '../../store/store';

import ArticleSummaryStyle from '../../style/components/Articles/ArticleSummary';
import getArticleTitle from '../../services/articles/getArticleTitle';

class ArticleSummary extends React.Component {

  constructor(props) {
    super(props);
  }

  getArticleLink() {
    return '/' + this.props.translations.routes.trips
         + '/' + this.props.article.visit.trip.urlName
         + '/' + this.props.article.city.country.urlName
         + '/' + this.props.article.city.urlName
         + '/' + this.props.article.city.visit.index
         + '/' + this.props.translations.routes.article
  }

  render() {
    return (
      <Link to={this.getArticleLink()}>
        <div className="article article-summary">
          <h3 style={ArticleSummaryStyle.h3}>
            {getArticleTitle(this.props.article)}
          </h3>
          <h6 style={ArticleSummaryStyle.h6}>
            {this.props.article.publishTime}
          </h6>
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

export default connect(
  state => ({ translations: state.translations })
)(ArticleSummary);
