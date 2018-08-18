import React from 'react';
import {Link} from 'react-router-dom';

class ArticlePath extends React.Component {

  constructor(props) {
    super(props);
  }

  getTripPath() {
    return '/trips/' + this.props.article.trip.urlName;
  }

  getCountryPath() {
    return '/countries/' + this.props.article.city.country.urlName;
  }

  getCityPath() {
    return '/countries/' + this.props.article.city.country.urlName
         + '/cities/' + this.props.article.city.urlName;
  }

  render() {

    return (
      <span className="article-path">
          /&nbsp;
          <Link to={this.getTripPath()}>
            {this.props.article.trip.name}
          </Link>
          &nbsp;/&nbsp;
          <Link to={this.getCountryPath()}>
            {this.props.article.city.country.name}
          </Link>
          &nbsp;/&nbsp;
          <Link to={this.getCityPath()}>
            {this.props.article.city.name}
          </Link>
      </span>
    );
  }
}

export default ArticlePath;
