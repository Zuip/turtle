import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class ArticlePageChanger extends React.Component {

  constructor(props) {
    super(props);
  }

  getPreviousArticleLink() {
    return '/' + this.props.translations.routes.trips
         + '/' + this.props.previousArticle.visit.trip.urlName
         + '/' + this.props.previousArticle.city.country.urlName
         + '/' + this.props.previousArticle.city.urlName
         + '/' + this.props.previousArticle.city.visit.index
         + '/' + this.props.translations.routes.article;
  }

  getNextArticleLink() {
    return '/' + this.props.translations.routes.trips
         + '/' + this.props.nextArticle.visit.trip.urlName
         + '/' + this.props.nextArticle.city.country.urlName
         + '/' + this.props.nextArticle.city.urlName
         + '/' + this.props.nextArticle.city.visit.index
         + '/' + this.props.translations.routes.article;
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
