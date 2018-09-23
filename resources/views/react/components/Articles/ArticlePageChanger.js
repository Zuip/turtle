import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import ArticleStyle from '../../style/components/Articles/Article';

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
      <Link
        to={this.getPreviousArticleLink()}
        className="btn btn-primary"
        style={ArticleStyle.pageChanger.previous}
      >

        <i className="fa fa-chevron-left"
           aria-hidden="true"
           style={ArticleStyle.pageChanger.iLeft}/>

        {this.props.translations.article.previous}

      </Link>
    );
  }

  nextArticleButton() {

    if(this.props.nextArticle === null) {
      return null;
    }

    return (
      <Link
        to={this.getNextArticleLink()}
        className="btn btn-primary"
        style={ArticleStyle.pageChanger.next}
      >

        {this.props.translations.article.next}

        <i className="fa fa-chevron-right"
           aria-hidden="true"
           style={ArticleStyle.pageChanger.iRight}/>

      </Link>
    );
  }

  render() {
    return (
      <div style={ArticleStyle.pageChanger}>
        {this.previousArticleButton()}
        {this.nextArticleButton()}
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticlePageChanger);
