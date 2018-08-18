import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class ArticlePageChanger extends React.Component {

  constructor(props) {
    super(props);
  }

  getPreviousArticleLink() {
    return '/trips/' + this.props.previousArticle.trip.urlName
           + '/' + this.props.previousArticle.city.country.urlName
           + '/' + this.props.previousArticle.city.urlName
           + '/' + this.props.previousArticle.city.visit.index
           + '/article';
  }

  getNextArticleLink() {
    return '/trips/' + this.props.nextArticle.trip.urlName
           + '/' + this.props.nextArticle.city.country.urlName
           + '/' + this.props.nextArticle.city.urlName
           + '/' + this.props.nextArticle.city.visit.index
           + '/article';
  }

  previousArticleButton() {

    if(this.props.previousArticle === null) {
      return null;
    }

    return (
      <Link to={this.getPreviousArticleLink()}
            className="btn btn-primary previous-article-button">

        <i className="fa fa-chevron-left" aria-hidden="true"></i>
        {this.props.translations.article.previous}
      </Link>
    );
  }

  nextArticleButton() {

    if(this.props.nextArticle === null) {
      return null;
    }

    return (
      <Link to={this.getNextArticleLink()}
            className="btn btn-primary next-article-button">

        {this.props.translations.article.next}
        <i className="fa fa-chevron-right" aria-hidden="true"></i>
      </Link>
    );
  }

  render() {
    return (
      <div>
        {this.previousArticleButton()}
        {this.nextArticleButton()}
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticlePageChanger);
