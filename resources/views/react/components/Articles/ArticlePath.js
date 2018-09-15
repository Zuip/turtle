import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class ArticlePath extends React.Component {

  constructor(props) {
    super(props);
  }

  getTripPath() {
    return '/' + this.props.translations.routes.trips
         + '/' + this.props.article.visit.trip.urlName;
  }

  getCountryPath() {
    return '/' + this.props.translations.routes.countries
         + '/' + this.props.article.city.country.urlName;
  }

  getCityPath() {
    return '/'+ this.props.translations.routes.countries
         + '/' + this.props.article.city.country.urlName
         + '/' + this.props.translations.routes.cities
         + '/' + this.props.article.city.urlName;
  }

  render() {

    return (
      <h5 className="article-path">
        <Link to={this.getTripPath()}>
          {this.props.article.visit.trip.name}
        </Link>
        &nbsp;/&nbsp;
        <Link to={this.getCountryPath()}>
          {this.props.article.city.country.name}
        </Link>
        &nbsp;/&nbsp;
        <Link to={this.getCityPath()}>
          {this.props.article.city.name}
        </Link>
      </h5>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticlePath);
