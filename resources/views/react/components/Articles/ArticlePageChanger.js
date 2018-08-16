import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class ArticlePageChanger extends React.Component {

  constructor(props) {
    super(props);
  }

  previousPageButton() {

    if(this.props.previousArticle === null) {
      return null;
    }

    return (
      <Link to={'/articles/' + this.props.previousArticle}
            className="btn btn-primary previous-article-button"
            role="button">

        <i className="fa fa-chevron-left" aria-hidden="true"></i>
        {this.props.translations.article.previous}
      </Link>
    );
  }

  nextPageButton() {

    if(this.props.nextArticle === null) {
      return null;
    }

    return (
      <Link to={'/articles/' + this.props.nextArticle}
            className="btn btn-primary next-article-button"
            role="button">

        {this.props.translations.article.next}
        <i className="fa fa-chevron-right" aria-hidden="true"></i>
      </Link>
    );
  }

  render() {
    return (
      <div>
        {this.previousPageButton()}
        {this.nextPageButton()}
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticlePageChanger);
