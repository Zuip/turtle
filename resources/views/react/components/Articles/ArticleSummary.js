import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';
import store from '../../store/store';

class ArticleSummary extends React.Component {

  constructor(props) {
    super(props);
  }

  getArticleLink() {
    return '/' + this.props.translations.routes.trips
         + '/' + this.props.article.trip.urlName
         + '/' + this.props.article.city.country.urlName
         + '/' + this.props.article.city.urlName
         + '/' + this.props.article.city.visit.index
         + '/' + this.props.translations.routes.article
  }

  render() {
    return (
      <Link to={this.getArticleLink()}>
        <div className="article article-summary">
          <h3>{this.props.article.city.name}, {this.props.article.city.country.name}</h3>
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

export default connect(
  state => ({ translations: state.translations })
)(ArticleSummary);
