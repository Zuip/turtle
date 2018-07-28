import React from 'react';
import {Link} from 'react-router-dom';

class ArticlePath extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    return (
      <span className="article-path">
          /&nbsp;
          <Link to={'/trips/' + this.props.article.trip.urlName}>
            {this.props.article.trip.name}
          </Link>
          &nbsp;/&nbsp;
          <Link to={'/countries/' + this.props.article.city.country.urlName}>
            {this.props.article.city.country.name}
          </Link>
          &nbsp;/&nbsp;
          <Link to={'/cities/' + this.props.article.city.urlName}>
            {this.props.article.city.name}
          </Link>
      </span>
    );
  }
}

export default ArticlePath;
