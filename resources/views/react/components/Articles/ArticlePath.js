import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import ArticleStyle from '../../style/components/Articles/Article';

import getCityPath from '../../services/paths/getCityPath';
import getCountryPath from '../../services/paths/getCountryPath';
import getTripPath from '../../services/paths/getTripPath';

class ArticlePath extends React.Component {

  constructor(props) {
    super(props);
  }

  getTripPath() {
    return getTripPath(
      this.props.article.visit.trip,
      this.props.translations
    );
  }

  getCountryPath() {
    return getCountryPath(
      this.props.article.city,
      this.props.translations
    );
  }

  getCityPath() {
    return getCityPath(
      this.props.article.city.country,
      this.props.article.city,
      this.props.translations
    );
  }

  getPublishTime() {
    return this.props.article.publishTime + ', ';
  }

  render() {

    return (
      <h6 style={ArticleStyle.path.h6}>
        {this.getPublishTime()}
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
      </h6>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(ArticlePath);
